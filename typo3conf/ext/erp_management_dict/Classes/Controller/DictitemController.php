<?php
namespace ERP\ErpManagementDict\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "数据字典" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * DictitemController
 */
class DictitemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * dictitemRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\DictitemRepository
     * @inject
     */
    protected $dictitemRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $dictitems = $this->dictitemRepository->findAll();
        $this->view->assign('dictitems', $dictitems);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem
     * @return void
     */
    public function showAction(\ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem)
    {
        $this->view->assign('dictitem', $dictitem);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $newDictitem
     * @return void
     */
    public function createAction(\ERP\ErpManagementDict\Domain\Model\Dictitem $newDictitem)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dictitemRepository->add($newDictitem);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem
     * @ignorevalidation $dictitem
     * @return void
     */
    public function editAction(\ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem)
    {
        $this->view->assign('dictitem', $dictitem);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem
     * @return void
     */
    public function updateAction(\ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dictitemRepository->update($dictitem);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementDict\Domain\Model\Dictitem $dictitem)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dictitemRepository->remove($dictitem);
        $this->redirect('list');
    }

    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');
        if ($cmd == 'getVariant') {
            $pvaId = GeneralUtility::_GP('pvaId');
            $dictitems = $this->findItemsByParent($pvaId);
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
        JSON(array('code'=>-1,'message'=>'没有请求的动作'));
    }

    public function getVariantAction()
    {
        
    }

    /**
     * @param $parentid
     */
    public function findItemsByParent($parentid)
    {
        return $this->dictitemRepository->findItemsByParent($parentid);
    }

    /**
     * @param $uid
     */
    public function findByUid($uid)
    {
        return $this->dictitemRepository->findByUid($uid);
    }
}
