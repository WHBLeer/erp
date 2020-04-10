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
 * CostController
 */
class CostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * costRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\CostRepository
     * @inject
     */
    protected $costRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $costs = $this->costRepository->findAll();
        $this->view->assign('costs', $costs);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     * @return void
     */
    public function showAction(\ERP\ErpManagementProduct\Domain\Model\Cost $cost)
    {
        $this->view->assign('cost', $cost);
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
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $newCost
     * @return void
     */
    public function createAction(\ERP\ErpManagementProduct\Domain\Model\Cost $newCost)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->costRepository->add($newCost);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     * @ignorevalidation $cost
     * @return void
     */
    public function editAction(\ERP\ErpManagementProduct\Domain\Model\Cost $cost)
    {
        $this->view->assign('cost', $cost);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     * @return void
     */
    public function updateAction(\ERP\ErpManagementProduct\Domain\Model\Cost $cost)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->costRepository->update($cost);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementProduct\Domain\Model\Cost $cost)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->costRepository->remove($cost);
        $this->redirect('list');
    }
}
