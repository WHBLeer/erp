<?php
namespace ERP\ErpManageProductTemplate\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * TemplateController
 */
class TemplateController extends ComController
{

    /**
     * templateRepository
     * 
     * @var \ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository
     * @inject
     */
    protected $templateRepository = null;

    /**
     * 产品
     * action list
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function listAction()
    {
        $templates = $this->templateRepository->findAll();
        $parents = $this->templateRepository->findAllParent();
        $this->view->assign('page', $this->page);
        $this->view->assign('templates', $templates);
        $this->view->assign('parents', $parents);
        $templatesJson = [];
        foreach ($templates as $k => $t) {
            // dump($t);
            $templatesJson[] = array(
                'id' => $t->getUid(), 
                'pid' => $t->getParentId(), 
                'number' => $k+1, 
                'name' => $t->getName().'('.$t->getNameEn().')', 
                'crdate' => $t->getCrdate()->format('Y-m-d'),
                'tstamp' => $t->getTstamp()->format('Y-m-d'),
            );
        }
        $this->view->assign('templatesJson', json_encode($templatesJson,JSON_UNESCAPED_UNICODE));
    }

    /**
     * action show
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function showAction(\ERP\ErpManageProductTemplate\Domain\Model\Template $template)
    {
        $this->view->assign('template', $template);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function newAction()
    {
        $this->view->assign('approvals', $this->getApprovals());
        $this->view->assign('shelvess', $this->getShelves());
        $this->view->assign('gettypes', $this->getGettypes());
    }

    /**
     * action create
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function createAction(\ERP\ErpManageProductTemplate\Domain\Model\Template $template)
    {
        $parent = $this->request->hasArgument('parent')?$this->request->getArgument('parent'):0;
        if ($parent>0) {
            $template->setParentId($parent);
            $template->setParent($this->templateRepository->findByUid($parent));
        }
        $this->addFlashMessage('模板信息已存储', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->templateRepository->add($template);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @ignorevalidation $template
     * @return void
     */
    public function editAction(\ERP\ErpManageProductTemplate\Domain\Model\Template $template)
    {
        $this->view->assign('template', $template);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function updateAction(\ERP\ErpManageProductTemplate\Domain\Model\Template $template)
    {
        $datas = $this->request->getArguments();

        // dump($datas);
        $template->setCategory($this->getCategoryById($datas['category']));
        $template->setApproval($this->getApprovalById($datas['approval']));
        $template->setShelves($this->getShelvesById($datas['shelves']));
        $template->setGtypes($this->getGettypeById($datas['gtypes']));
        $template->setInfo($this->saveInfo($datas['info']));
        $template->setCost($this->saveCost($datas['cost']));
        foreach ($datas['desc'] as $key => $des) {
            $desc = $this->saveDesc($key, $des);
            if ($des['uid'] == 0) {
                $template->addDescr($desc);
            }
        }
        $imguids = array_filter(GeneralUtility::trimExplode(',', ltrim($template->getImageuids(), ',')));
        if (!empty($imguids)) {
            for ($i = 0; $i < count($imguids); $i++) {
                $image = $this->imagesRepository->findByUid($imguids[$i]);
                if (!$image == false) {
                    $template->addImage($image);
                }
            }
        }
        $this->addFlashMessage('商品信息已存储', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->templateRepository->update($template);
        $this->persistanceManager->persistAll();

        // dump($template);exit;
        $this->redirect('listZX');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function deleteAction(\ERP\ErpManageProductTemplate\Domain\Model\Template $template)
    {
        $this->addFlashMessage('数据已删除!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->templateRepository->remove($template);
        $this->redirect('list');
    }

    /**
     * 批量处理
     * 
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     * @return void
     */
    public function batchAction()
    {
        $items = $this->request->hasArgument('datas') ? $this->request->getArgument('datas') : array();
        if ($items['items']) {
            $item = substr($items['items'], 0, strlen($items['items']) - 1);
            $iRet = $this->newsRepository->deleteByUidstring($item);
            if ($iRet > 0) {
                $this->addFlashMessage('删除成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);

                //刷新前台缓存
                GeneralUtility::makeInstance(CacheManager::class)->flushCachesInGroup('pages');
            } else {
                $this->addFlashMessage('删除失败！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            }
            $this->redirect('list');
        }
        $this->addFlashMessage('没有可删除对象！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->redirect('list');
    }

    /**
     * @param ERP\ErpManageTemplateTemplate\Domain\Model\Template
     */
    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');

        // 变体
        if ($cmd == 'getVariant') {
            $pvaId = GeneralUtility::_GP('pvaId');
            $dictitems = $this->getVariant($pvaId);
            $datas = array();
            foreach ($dictitems as $key => $item) {
                $datas[] = array(
                'uid' => $item->getUid(), 
                'name' => $item->getName(), 
                'code' => $item->getCode(), 
                'parent' => $item->getDicttype()->getUid()
                );
            }
            JSON($datas);
        }

        // 变体图片
        if ($cmd == 'getVariantImages') {
            $dataid = GeneralUtility::_GP('dataid');
            $datas = $this->getVariantImages($dataid);
            JSON($datas);
        }
        JSON(array('code' => -1, 'message' => '没有请求的动作'));
    }

    /**
     * action getTemplate
     * 
     * @return void
     */
    public function getTemplateAction()
    {
    }
}
