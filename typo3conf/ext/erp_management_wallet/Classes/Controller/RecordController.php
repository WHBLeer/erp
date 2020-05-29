<?php
namespace ERP\ErpManagementWallet\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
 * RecordController
 */
class RecordController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * recordRepository
     * 
     * @var \ERP\ErpManagementWallet\Domain\Repository\RecordRepository
     * @inject
     */
    protected $recordRepository = null;
    public function initializeAction()
    {
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function listAction()
    {
        $logisticses = $this->logisticsRepository->findAll();
        $this->view->assign('logisticses', $logisticses);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function showAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->view->assign('logistics', $logistics);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function createAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('物流信息新增成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->add($logistics);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @ignorevalidation $record
     * @return void
     */
    public function editAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->view->assign('logistics', $logistics);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function updateAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('物流信息编辑成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->update($logistics);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('物流信息删除成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->remove($logistics);
        $this->redirect('list');
    }

    /**
     * action api
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function apiAction()
    {
        dump($_GET);
        dump($_POST);
        exit;
    }

    /**
     * action callback
     * 
     * @return void
     */
    public function callbackAction()
    {
    }

    /**
     * action success
     * 
     * @return void
     */
    public function successAction()
    {
    }
}
