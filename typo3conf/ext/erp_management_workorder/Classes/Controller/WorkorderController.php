<?php
namespace ERP\ErpManagementWorkorder\Controller;


/***
 *
 * This file is part of the "工单模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * WorkorderController
 */
class WorkorderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * workorderRepository
     * 
     * @var \ERP\ErpManagementWorkorder\Domain\Repository\WorkorderRepository
     * @inject
     */
    protected $workorderRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $workorders = $this->workorderRepository->findAll();
        $this->view->assign('workorders', $workorders);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder
     * @return void
     */
    public function showAction(\ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder)
    {
        $this->view->assign('workorder', $workorder);
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
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Workorder $newWorkorder
     * @return void
     */
    public function createAction(\ERP\ErpManagementWorkorder\Domain\Model\Workorder $newWorkorder)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->workorderRepository->add($newWorkorder);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder
     * @ignorevalidation $workorder
     * @return void
     */
    public function editAction(\ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder)
    {
        $this->view->assign('workorder', $workorder);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder
     * @return void
     */
    public function updateAction(\ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->workorderRepository->update($workorder);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementWorkorder\Domain\Model\Workorder $workorder)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->workorderRepository->remove($workorder);
        $this->redirect('list');
    }

    /**
     * action submit
     * 
     * @return void
     */
    public function submitAction()
    {
    }

    /**
     * action qlist
     * 
     * @return void
     */
    public function qlistAction()
    {
    }

    /**
     * action alist
     * 
     * @return void
     */
    public function alistAction()
    {
    }
}
