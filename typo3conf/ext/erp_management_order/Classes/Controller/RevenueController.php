<?php
namespace ERP\ErpManagementOrder\Controller;


/***
 *
 * This file is part of the "订单管理系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
/**
 * RevenueController
 */
class RevenueController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * revenueRepository
     * 
     * @var \ERP\ErpManagementOrder\Domain\Repository\RevenueRepository
     * @inject
     */
    protected $revenueRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $revenues = $this->revenueRepository->findAll();
        $this->view->assign('revenues', $revenues);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @return void
     */
    public function showAction(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue)
    {
        $this->view->assign('revenue', $revenue);
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
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $newRevenue
     * @return void
     */
    public function createAction(\ERP\ErpManagementOrder\Domain\Model\Revenue $newRevenue)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->revenueRepository->add($newRevenue);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @ignorevalidation $revenue
     * @return void
     */
    public function editAction(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue)
    {
        $this->view->assign('revenue', $revenue);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @return void
     */
    public function updateAction(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->revenueRepository->update($revenue);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->revenueRepository->remove($revenue);
        $this->redirect('list');
    }

    public function saveRevenue($data=[])
    {
        if (isset($data['uid'])) {
            $revenue = $this->revenueRepository->findByUid($data['uid']);
            $function = 'update';
        } else {
            $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue;
            $function = 'add';
        }
        $revenue->setOrderAmount($data['orderAmount']);
        // $revenue->setCommission($data['commission']);
        // $revenue->setArrive($data['arrive']);
        // $revenue->setCostAmount($data['costAmount']);
        // $revenue->setFreight($data['freight']);
        // $revenue->setServiceFee($data['serviceFee']);
        // $revenue->setProfit($data['profit']);
        // $revenue->setProfitMargin($data['profitMargin']);
        dump($revenue);
        $revenue = $this->revenueRepository->$function($revenue);
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
        dump($revenue);
        return $revenue;
    }
}
