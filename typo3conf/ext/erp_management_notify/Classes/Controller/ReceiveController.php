<?php
namespace ERP\ErpManagementNotify\Controller;


/***
 *
 * This file is part of the "消息通知系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * ReceiveController
 */
class ReceiveController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * receiveRepository
     * 
     * @var \ERP\ErpManagementNotify\Domain\Repository\ReceiveRepository
     * @inject
     */
    protected $receiveRepository = null;

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * action ajax
     * 
     * @return void
     */
    public function ajaxAction()
    {
    }
}
