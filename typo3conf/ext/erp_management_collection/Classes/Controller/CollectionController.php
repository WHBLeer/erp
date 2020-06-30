<?php
namespace ERP\ErpManagementCollection\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

require_once(ExtensionManagementUtility::extPath('erp_management_collection') . 'Classes/Library/QueryList/phpQuery.php');
require_once(ExtensionManagementUtility::extPath('erp_management_collection') . 'Classes/Library/QueryList/QueryList.php');

use ERP\ErpManagementCollection\Lib\QueryList;
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
 * CollectionController
 */
class CollectionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * collectionRepository
     * 
     * @var \ERP\ErpManagementCollection\Domain\Repository\CollectionRepository
     * @inject
     */
    protected $collectionRepository = null;

    public function initializeAction(){
        // require_once (ExtensionManagementUtility::extPath('erp_management_collection') . 'Classes/Library/QueryList/phpQuery.php');
        // require_once (ExtensionManagementUtility::extPath('erp_management_collection') . 'Classes/Library/QueryList/QueryList.php');
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function listAction()
    {
        //采集某页面所有的图片 
        // $url = "https://detail.1688.com/offer/45584567085.html?spm=a2609.8365180.j6oxudco.9.4ec9a02be1soZi&tracelog=p4p&clickid=4e3f7cecb22d456f81573a77a3650552&sessionid=3f78705cd8992be90b090a4ae2600872";
        // $hj = QueryList::Query($url,array("title"=>array('h1.d-title','text')));
        // var_dump($hj->data);
        $collections = $this->collectionRepository->findAll();
        $this->view->assign('collections', $collections);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function showAction(\ERP\ErpManagementCollection\Domain\Model\Collection $collection)
    {
        $this->view->assign('collection', $collection);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function createAction(\ERP\ErpManagementCollection\Domain\Model\Collection $collection)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->collectionRepository->add($collection);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @ignorevalidation $collection
     * @return void
     */
    public function editAction(\ERP\ErpManagementCollection\Domain\Model\Collection $collection)
    {
        $this->view->assign('collection', $collection);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function updateAction(\ERP\ErpManagementCollection\Domain\Model\Collection $collection)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->collectionRepository->update($collection);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementCollection\Domain\Model\Collection
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementCollection\Domain\Model\Collection $collection)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->collectionRepository->remove($collection);
        $this->redirect('list');
    }

    /**
     * action api
     * 
     * @return void
     */
    public function apiAction()
    {
        
        $cmd = GeneralUtility::_GP('cmd');

        // 检查用户登录
        if ($cmd=="user_check") {
            $user = $GLOBALS['TSFE']->fe_user->user;
            if ($user['ses_userid']>0) {
                $result = array(
                    'code' => 1,
                    'offweb' => 'https://erp.whongbin.com/',
                    'data' => array(
                        'userinfo' => array(
                            'name' => $user['name'],
                            'username' => $user['username'],
                            // 'company' => $user['company'],
                            'company' => '测试账号',
                            // 'nickname' => $user['nickname'],
                            'nickname' => '王宏彬',
                            'adminurl' => 'https://erp.whongbin.com/system/profile',
                        ),
                        'activesite' => array(
                            '1688' => 'https://www.1688.com/',
                            '淘宝' => 'https://www.taobao.com/',
                            '天猫' => 'https://www.tmall.com/',
                        ),
                    )
                );
            } else {
                $result = array(
                    'code' => 0,
                    'offweb' => 'https://erp.whongbin.com/',
                    'data' => array(
                        'url' => 'https://erp.whongbin.com/login',
                    )
                );
            }
            JSON($result);
        }

        // 淘宝采集
        if ($cmd=="submit_taobao") {
            $user = $GLOBALS['TSFE']->fe_user->user;
            if ($user['ses_userid']>0) {
                $result = array(
                    'code' => 1,
                    'data' => array(
                        'userinfo' => array(
                            'name' => $user['name'],
                            'username' => $user['username'],
                            // 'company' => $user['company'],
                            'company' => '测试账号',
                            // 'nickname' => $user['nickname'],
                            'nickname' => '王宏彬',
                            'adminurl' => 'https://erp.whongbin.com/system/profile',
                        ),
                        'activesite' => array(
                            '1688' => 'https://www.1688.com/',
                            '淘宝' => 'https://www.taobao.com/',
                            '天猫' => 'https://www.tmall.com/',
                        ),
                    )
                );
            } else {
                $result = array(
                    'code' => 0,
                    'data' => array(
                        'url' => 'https://erp.whongbin.com/login',
                    )
                );
            }
            JSON($result);
        }
        exit;
    }
}
