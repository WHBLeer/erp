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
 * WalletController
 */
class WalletController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * walletRepository
     * 
     * @var \ERP\ErpManagementWallet\Domain\Repository\WalletRepository
     * @inject
     */
    protected $walletRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $wallets = $this->walletRepository->findAll();
        $this->view->assign('wallets', $wallets);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Wallet $wallet
     * @return void
     */
    public function showAction(\ERP\ErpManagementWallet\Domain\Model\Wallet $wallet)
    {
        $this->view->assign('wallet', $wallet);
    }

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
        $wallets = $this->walletRepository->findAll();
        $this->view->assign('wallets', $wallets);
    }

    /**
     * action topup
     * 
     * @return void
     */
    public function topupAction()
    {
        $wallets = $this->walletRepository->findAll();
        $this->view->assign('wallets', $wallets);
    }

    /**
     * action callback
     * 
     * @return void
     */
    public function callbackAction()
    {
        $wallets = $this->walletRepository->findAll();
        $this->view->assign('wallets', $wallets);
    }
}
