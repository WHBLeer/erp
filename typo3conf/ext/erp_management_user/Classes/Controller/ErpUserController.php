<?php
namespace ERP\ErpManagementUser\Controller;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Crypto\Random;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;

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
require_once ExtensionManagementUtility::extPath('erp_management_interaction') . 'Classes/Library/ErpServerApi.php';

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
 * ErpUserController
 */
class ErpUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * erpUserRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserRepository
     * @inject
     */
    protected $erpUserRepository = null;

    /**
     * erpUserGroupRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserGroupRepository
     * @inject
     */
    protected $erpUserGroupRepository = null;

    /**
     * erpUserAuthRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserAuthRepository
     * @inject
     */
    protected $erpUserAuthRepository = null;

    /**
     * regionRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\RegionRepository
     * @inject
     */
    protected $regionRepository = null;
    protected $dictitemController = null;
    protected $dicttypeController = null;
    protected $regionController = null;
    protected $page = 0;
    public function initializeAction()
    {
        $this->dictitemController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\DictitemController::class);
        $this->dicttypeController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\DicttypeController::class);
        $this->regionController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\RegionController::class);
        if ($_GET['tx_erpmanagementuser_pi1']['@widget_0']['currentPage']) {
            $this->page = $_GET['tx_erpmanagementuser_pi1']['@widget_0']['currentPage'];
        } else {
            $this->page = 1;
        }
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $erpUsers = $this->erpUserRepository->findAll();
        $this->view->assign('erpUsers', $erpUsers);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function showAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->view->assign('erpUser', $erpUser);
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
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $newErpUser
     * @return void
     */
    public function createAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $newErpUser)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->add($newErpUser);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @ignorevalidation $erpUser
     * @return void
     */
    public function editAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->view->assign('erpUser', $erpUser);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function updateAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->update($erpUser);
        $actionname = $this->request->hasArgument('actionname') ? $this->request->getArgument('actionname') : 'list';
        $this->redirect($actionname);
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->remove($erpUser);
        $this->redirect('list');
    }

    /**
     * action register
     * 
     * @return void
     */
    public function registerAction()
    {
    }

    /**
     * action profile
     * 
     * @return void
     */
    public function profileAction()
    {
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $erpUser = $this->erpUserRepository->findByUid($userid);
        $provinces = $this->regionRepository->findByParent(0);
        if ($erpUser->getCitys()) {
            $this->view->assign('citys', [$erpUser->getCitys()]);
        }
        $this->view->assign('erpUser', $erpUser);
        $this->view->assign('provinces', $provinces);
        
    }
    
    /**
     * action oauth
     * 
     * @return void
     */
    public function oauthAction()
    {
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $erpUser = $this->erpUserRepository->findByUid($userid);
        $this->view->assign('erpUser', $erpUser);

        //获取大区
        $markets = $this->dicttypeController->findByUids([8,9]);
        $this->view->assign('markets', $markets);

        $this->view->assign('page', $this->page);
    }

    /**
     * action saveoauth
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function saveoauthAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        // 生成授权码并保存
        $erpUser->setAccountId(md5(sha1($erpUser->getUid() . time())));
        $authData = $this->request->getArgument('auth');
        $coun = $this->dictitemController->findItemsByParent($authData['market']);
        $market = $this->dicttypeController->findByUid($authData['market']);
        //与服务端数据对接
        $params = array(
            'accountId' => $erpUser->getAccountId(), 
            'sellerId' => $authData['amazon_id'], 
            'sellerToken' => $authData['amazon_token'], 
            'developerId' => $market->getDevid(), 
            'amazonAccountId' => $authData['awsaccount'], 
            'marketplaceId' => $market->getCode(), 
            'operator' => 1
        );
        $ErpServer = new \ERP\Api\ErpServer\ErpUserApi();
        $res = $ErpServer->addUserAuthorized($params);
        // dump($res);exit;
        if ($res['rspCode'] == 0) {
            
            //授权信息
            $country = [];
            foreach ($coun as $key => $con) $country[] = ['lang' => $con->getLang(),'name'=>$con->getName()];
            $auth = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
            $auth->setAuthCode($res['authCode']);
            $auth->setShopalias($authData['shopalias']);
            $auth->setAwsaccount($authData['awsaccount']);
            $auth->setAuthcountry(json_encode($country,JSON_UNESCAPED_UNICODE ));
            $auth->setAuthtime(time());
            $auth->setAmazonId($authData['amazon_id']);
            $auth->setAmazonToken($authData['amazon_token']);
            $auth->setAuthtype(0);
            $auth->setMarket($market);
            $this->erpUserAuthRepository->add($auth);
            $this->refreshObject();
            $erpUser->addAuth($auth);

            if (!$erpUser->getPosition()) {
                //位置信息不存在时插入
                $ip = $this->get_real_ip();
                $url = "https://apis.map.qq.com/ws/location/v1/ip?ip=$ip&key=7I6BZ-CN73D-XVG4Y-H5CYY-XRB7Z-MFFWS";
                $res = json_decode(file_get_contents($url),true);
                $position = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
                $position->setIp($res['result']['ip']);
                $position->setLocatlat($res['result']['location']['lat']);
                $position->setLocatLng($res['result']['location']['lng']);
                $position->setNation($res['result']['ad_info']['nation']);
                $position->setProvince($res['result']['ad_info']['province']);
                $position->setCity($res['result']['ad_info']['city']);
                $position->setDistrict($res['result']['ad_info']['district']);
                $position->setAdcode($res['result']['ad_info']['adcode']);
                $this->positionRepository->add($position);
                $this->refreshObject();
                $erpUser->setPosition($position);
            }
            $this->erpUserRepository->update($erpUser);

            $this->addFlashMessage('授权成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        } else {
            $this->addFlashMessage('授权失败,请重新授权或联系管理员', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        
        $this->redirect('oauth');
    }

    /**
     * action changepwd
     * 
     * @return void
     */
    public function changepwdAction()
    {
    }

    /**
     * action retrievepwd
     * 
     * @return void
     */
    public function retrievepwdAction()
    {
    }

    /**
     * action check
     * 
     * @return void
     */
    public function checkAction()
    {
    }

    /**
     * action ajaxdata
     * 
     * @return void
     */
    public function ajaxdataAction()
    {
        $cmd = GeneralUtility::_GP('cmd');
        if ($cmd == 'get_city') {

            //获取市
            $provice = GeneralUtility::_GP('provice');
            $citys = $this->regionRepository->findByParent($provice);
            $data = array();
            foreach ($citys as $k => $c) {
                $data[] = array(
                'uid' => $c->getUid(), 
                'name' => $c->getName()
                );
            }
            JSON(
            array(
            'code' => 1, 
            'message' => '城市查询成功!', 
            'data' => $data
            )
            );
        }

        //管理员发起授权
        if ($cmd == 'addAuthRequest') {
            $userids = explode(',', GeneralUtility::_GP('userids'));
            $operator = GeneralUtility::_GP('operator');
            $messages = array();
            foreach ($userids as $uid) {
                $erpUser = $this->erpUserRepository->findByUid($uid);

                //与服务端数据对接
                $params = array(
                'accountId' => $erpUser->getAuthcode(), 
                'sellerId' => $erpUser->getAwsid(), 
                'sellerToken' => $erpUser->getAwstoken(), 
                'developerId' => $erpUser->getDeveloperid(), 
                'amazonAccountId' => $erpUser->getAwsaccount(), 
                'marketplaceId' => $erpUser->getMarket()->getCode(), 
                'operator' => $operator
                );
                $ErpServer = new \ERP\Api\ErpServer\ErpUserApi();
                $res = $ErpServer->addUserAuthorized($params);
                if ($res == 0) {
                    $erpUser->setAuthcode($res['authCode']);
                    $this->erpUserRepository->update($erpUser);
                    $messages[] = array(
                    'code' => 1, 
                    'uid' => $erpUser->getUid(), 
                    'message' => $erpUser->getName() . '授权成功!'
                    );
                } else {
                    $messages[] = array(
                    'code' => 0, 
                    'uid' => $erpUser->getUid(), 
                    'message' => $erpUser->getName() . '授权失败!'
                    );
                }
            }
            JSON($messages);
        }

        //管理员终止授权
        if ($cmd == 'delAuthRequest') {
            $provice = GeneralUtility::_GP('provice');
            $provice = GeneralUtility::_GP('provice');
            $provice = GeneralUtility::_GP('provice');
        }
        JSON(
        array(
        'code' => 0, 
        'message' => '没有定义请求接口!'
        )
        );
    }

    /**
     * 获取真实IP地址
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-24
     */
    public function get_real_ip()
    {
        $ip=FALSE;
        //客户端IP 或 NONE 
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        //客户端IP 或 (最后一个)代理服务器 IP 
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);

    }

    /**
     * 对象存储刷新
     * 
     * @return [type] [description]
     */
    public function refreshObject()
    {
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}
