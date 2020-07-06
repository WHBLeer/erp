<?php
namespace ERP\ErpManagementLogistics\Controller;


/***
 *
 * This file is part of the "物流管理系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * ParcelsController
 */
class ParcelsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * parcelsRepository
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Repository\ParcelsRepository
     * @inject
     */
    protected $parcelsRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $parcels = $this->parcelsRepository->findAll();
        $this->view->assign('parcels', $parcels);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels
     * @return void
     */
    public function showAction(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels)
    {
        $this->view->assign('parcels', $parcels);
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
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $newParcels
     * @return void
     */
    public function createAction(\ERP\ErpManagementLogistics\Domain\Model\Parcels $newParcels)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->parcelsRepository->add($newParcels);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels
     * @ignorevalidation $parcels
     * @return void
     */
    public function editAction(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels)
    {
        $this->view->assign('parcels', $parcels);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels
     * @return void
     */
    public function updateAction(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->parcelsRepository->update($parcels);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcels)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->parcelsRepository->remove($parcels);
        $this->redirect('list');
    }
}
