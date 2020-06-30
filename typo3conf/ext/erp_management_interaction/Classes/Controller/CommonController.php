<?php
namespace ERP\ErpManagementInteraction\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
 * CommonController
 */
class CommonController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $user_session = null;

    protected $error_message = array(
        'code' => 0,
        'message' => '当前没有请求的方法!',
    );

    protected $login_message = array(
        'code' => 0,
        'home' => 'https://erp.whongbin.com/',
        'message' => '当前未登录!',
        'data' => array(
            'url' => 'https://erp.whongbin.com/erp/login/',
        )
    );

    /**
     * interactionRepository
     * 
     * @var \ERP\ErpManagementInteraction\Domain\Repository\InteractionRepository
     * @inject
     */
    protected $interactionRepository = null;

    public function initializeAction()
    {
        // file_put_contents('/var/www/html/erp.whongbin.com/logs/apilog.log', date('Y-m-d H:i:s') .'==_GET=='. json_encode( $_GET ). chr(10) . chr(10), FILE_APPEND | LOCK_EX);
        file_put_contents('/var/www/html/erp.whongbin.com/logs/apilog.log', date('Y-m-d H:i:s') .'==_POST=='. json_encode( $_POST ) . chr(10) . chr(10), FILE_APPEND | LOCK_EX);
        
        // 每次请求判断session是否存在
        if (!isset($GLOBALS['TSFE']->fe_user->user['ses_userid'])) {
            $this->user_session = $GLOBALS['TSFE']->fe_user->user;
            JSON($this->login_message);
        }
    }

    /**
     * 插件用户信息
     *
     * @param array $params
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-02
     */
    public function user_info($params=[])
    {
        $result = array(
            'code' => 1,
            'offweb' => 'https://erp.whongbin.com/',
            'data' => array(
                'userinfo' => array(
                    'name' => $this->user_session['name'],
                    'username' => $this->user_session['username'],
                    'company' => $this->user_session['company'],
                    'nickname' => $this->user_session['nickname'],
                    'adminurl' => 'https://erp.whongbin.com/erp/system/profile',
                ),
                'activesite' => array(
                    '1688' => 'https://www.1688.com/',
                    '淘宝' => 'https://www.taobao.com/',
                    '天猫' => 'https://www.tmall.com/',
                ),
            )
        );
        return $result;
    }

    /**
     * 淘宝采集
     *
     * @param array $params
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-02
     */
    public function collection_tb($params=[])
    {
        $result = array(
            'code' => 1,
            'msg' => '采集成功!',
        );
        return $result;
    }

    /**
     * 天猫采集
     *
     * @param array $params
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-02
     */
    public function collection_tm($params=[])
    {
        $result = array(
            'code' => 1,
            'msg' => '采集成功!',
        );
        return $result;
    }

    /**
     * 1688采集
     *
     * @param array $params
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-02
     */
    public function collection_1688($params=[])
    {
        if (!empty($params)) {
            if (count($params['datas']['pics'])>0) {
                $result = array(
                    'code' => 200,
                    'msg' => '采集成功!',
                );
            }else{
                $result = array(
                    'code' => 100,
                    'msg' => '数据为空,继续采集!',
                );
            }
            
        } else {
            $result = array(
                'code' => 0,
                'msg' => '请求错误!',
            );
        }
        
        return $result;
    }

}
