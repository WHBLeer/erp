<?php
namespace ERP\ErpManagementProduct\Controller;


/***
 *
 * This file is part of the "产品管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * InfoController
 */
class InfoController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * infoRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\InfoRepository
     * @inject
     */
    protected $infoRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $infos = $this->infoRepository->findAll();
        $this->view->assign('infos', $infos);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $info
     * @return void
     */
    public function showAction(\ERP\ErpManagementProduct\Domain\Model\Info $info)
    {
        $this->view->assign('info', $info);
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
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $newInfo
     * @return void
     */
    public function createAction(\ERP\ErpManagementProduct\Domain\Model\Info $newInfo)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->infoRepository->add($newInfo);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $info
     * @ignorevalidation $info
     * @return void
     */
    public function editAction(\ERP\ErpManagementProduct\Domain\Model\Info $info)
    {
        $this->view->assign('info', $info);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $info
     * @return void
     */
    public function updateAction(\ERP\ErpManagementProduct\Domain\Model\Info $info)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->infoRepository->update($info);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $info
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementProduct\Domain\Model\Info $info)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->infoRepository->remove($info);
        $this->redirect('list');
    }
}
