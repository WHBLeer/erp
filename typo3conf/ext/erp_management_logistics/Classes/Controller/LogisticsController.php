<?php
namespace ERP\ErpManagementLogistics\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use ERP\Api\Logistics\LogisticsYunTuApi;
require_once ExtensionManagementUtility::extPath('erp_management_logistics') . 'Classes/Library/YunTuApi.php';

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
 * LogisticsController
 */
class LogisticsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * logisticsRepository
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Repository\LogisticsRepository
     * @inject
     */
    protected $logisticsRepository = null;
    public function initializeAction()
    {
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function listAction()
    {
        $logisticses = $this->logisticsRepository->findAll();
        $this->view->assign('logisticses', $logisticses);

        // $data = ['CountryCode'=>'GB'];
        // $res = LogisticsYunTuApi::GetShippingMethods($data);
        // dump($res);
        // exit;
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function showAction(\ERP\ErpManagementLogistics\Domain\Model\Logistics $logistics)
    {
        $this->view->assign('logistics', $logistics);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function createAction(\ERP\ErpManagementLogistics\Domain\Model\Logistics $logistics)
    {
        $this->addFlashMessage('物流信息新增成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->add($logistics);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @ignorevalidation $logistics
     * @return void
     */
    public function editAction(\ERP\ErpManagementLogistics\Domain\Model\Logistics $logistics)
    {
        $this->view->assign('logistics', $logistics);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function updateAction(\ERP\ErpManagementLogistics\Domain\Model\Logistics $logistics)
    {
        $this->addFlashMessage('物流信息编辑成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->update($logistics);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementLogistics\Domain\Model\Logistics $logistics)
    {
        $this->addFlashMessage('物流信息删除成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logisticsRepository->remove($logistics);
        $this->redirect('list');
    }

    /**
     * action api
     * 
     * @param ERP\ErpManagementLogistics\Domain\Model\Logistics
     * @return void
     */
    public function apiAction()
    {
        $cmd = GeneralUtility::_GP('cmd');

        // 运输方式
        if ($cmd == 'GetShippingMethods') {
            $res = LogisticsYunTuApi::GetShippingMethods();
            if ($res['Code'] == '0000') {
                JSON($res['Items']);
            } else {
                JSON(array('code' => $res['Code'], 'message' => $res['Message']));
            }
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
     * 提交物流信息
     * action push
     * 
     * @return void
     */
    public function pushAction()
    {
    }

    /**
     * 拉取物流信息
     * action pull
     * 
     * @return void
     */
    public function pullAction()
    {
    }
}
