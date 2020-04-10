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
 * DescController
 */
class DescController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $descs = $this->descRepository->findAll();
        $this->view->assign('descs', $descs);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $desc
     * @return void
     */
    public function showAction(\ERP\ErpManagementProduct\Domain\Model\Desc $desc)
    {
        $this->view->assign('desc', $desc);
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
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $newDesc
     * @return void
     */
    public function createAction(\ERP\ErpManagementProduct\Domain\Model\Desc $newDesc)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->descRepository->add($newDesc);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $desc
     * @ignorevalidation $desc
     * @return void
     */
    public function editAction(\ERP\ErpManagementProduct\Domain\Model\Desc $desc)
    {
        $this->view->assign('desc', $desc);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $desc
     * @return void
     */
    public function updateAction(\ERP\ErpManagementProduct\Domain\Model\Desc $desc)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->descRepository->update($desc);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $desc
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementProduct\Domain\Model\Desc $desc)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->descRepository->remove($desc);
        $this->redirect('list');
    }
}
