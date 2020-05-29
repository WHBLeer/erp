<?php
namespace ERP\ErpManagementWallet\Controller;


/***
 *
 * This file is part of the "钱包模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * LogController
 */
class LogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * logRepository
     * 
     * @var \ERP\ErpManagementWallet\Domain\Repository\LogRepository
     * @inject
     */
    protected $logRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $logs = $this->logRepository->findAll();
        $this->view->assign('logs', $logs);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Log $log
     * @return void
     */
    public function showAction(\ERP\ErpManagementWallet\Domain\Model\Log $log)
    {
        $this->view->assign('log', $log);
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
     * @param \ERP\ErpManagementWallet\Domain\Model\Log $newLog
     * @return void
     */
    public function createAction(\ERP\ErpManagementWallet\Domain\Model\Log $newLog)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->logRepository->add($newLog);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Log $log
     * @ignorevalidation $log
     * @return void
     */
    public function editAction(\ERP\ErpManagementWallet\Domain\Model\Log $log)
    {
        $this->view->assign('log', $log);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Log $log
     * @return void
     */
    public function updateAction(\ERP\ErpManagementWallet\Domain\Model\Log $log)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->logRepository->update($log);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Log $log
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementWallet\Domain\Model\Log $log)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->logRepository->remove($log);
        $this->redirect('list');
    }

    /**
     * action pull
     * 
     * @return void
     */
    public function pullAction()
    {
    }

    /**
     * action push
     * 
     * @return void
     */
    public function pushAction()
    {
    }
}
