<?php
namespace Sll\Common\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
/***
 *
 * This file is part of the "通用配置" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
require_once(ExtensionManagementUtility::extPath('common') . 'Classes/Library/ftp.php');
/**
 * ConfigController
 */
class ConfigController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * configRepository
     * 
     * @var \Sll\Common\Domain\Repository\ConfigRepository
     * @inject
     */
    protected $configRepository = null;

    protected $ftpsever = '';

    public function initializeAction()
    {
        
        $this->ftpsever = $GLOBALS['TYPO3_CONF_VARS']['FTP']['sever'].'static/';
        
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        // $this->view->assign('hash', uniqid(microtime()));
        $this->view->assign('TYPO3_CONF_VARS', $GLOBALS['TYPO3_CONF_VARS']);
        $this->view->assign('ftpsever', $this->ftpsever);

        // require_once (ExtensionManagementUtility::extPath('common') . 'Classes/Library/translate.php');
        // //配置
        // $config = $GLOBALS['TYPO3_CONF_VARS']['FTP'];
        // $trans = new \Sll\Common\Library\Translate(['app_key' => '0818b92eedfc0200','sec_key' => 'WDP5dSKyE4eKHmq0BgnZr2uOCs90l6Is']);
        // $q = "欢迎使用本系统";
        // dump($trans);
        // $ret = $trans->do_request($q,'zh-CHS','it');
        // dump($ret);
        // $ret = json_decode($ret, true);
        // dump($ret);
    }

    /**
     * action update
     * 
     * @param \Sll\Common\Domain\Model\Config $config
     * @return void
     */
    public function updateAction()
    {
        // dump($this->request->getArguments());exit;
        $errorArray = array();
        $fileConfArr = array();
        if ($this->request->hasArgument('label') && $this->request->getArgument('label')=='file') {
            if(!empty($_FILES['favicon']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['favicon'],'static','favicon.ico');
                $fileConfArr['FILE']['favicon'] = $file;
                
            }
            //logo_sm
            if(!empty($_FILES['logo_sm']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['logo_sm'],'static','logo_sm.svg');
                $fileConfArr['FILE']['logo_sm'] = $file;
            }

            //logo
            if(!empty($_FILES['logo']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['logo'],'static','logo.svg');
                $fileConfArr['FILE']['logo'] = $file;
            }
            
            //loginlogo
            if(!empty($_FILES['login_logo']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['login_logo'],'static','login_logo.svg');
                $fileConfArr['FILE']['login_logo'] = $file;
            }

            //banner_inner
            if(!empty($_FILES['banner_inner']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['banner_inner'],'static','banner_inner.jpg');
                $fileConfArr['FILE']['banner_inner'] = $file;
            }

            //login_bg
            if(!empty($_FILES['login_bg']['tmp_name'])){
                $file = $this->uploadForFtp($_FILES['login_bg'],'static','login_bg.jpg');
                $fileConfArr['FILE']['login_bg'] = $file;
            }
        }
        // dump($fileConfArr);
        // exit;
        // site title
        $this->updateValue([ 'sitetitle' => GeneralUtility::_GP('sitename') ], 'sys_template', [ 'uid' => 1 ]);
            
        //################################switch template begin##############################
        //查询config和constants
        $ts = $this->getValue(['config', 'constants'], 'sys_template', [ 'uid' => 1 ]);
        //循环处理config的数据
        $tsArray = GeneralUtility::trimExplode(chr(10), $ts['config']);
        foreach ($tsArray as $key=>$val) {
            if(preg_match("/FILE\:EXT\:common\/Configuration\/TypoScript\/plugin\.typoscript/is", $val)){
                unset($tsArray[$key]);
            }
            if(preg_match("/config\.baseURL/is", $val)){
                unset($tsArray[$key]);
            }
        }
        array_unshift($tsArray, 'config.baseURL = ' . $_POST['TYPO3_CONF_VARS']['FE']['baseURL']);
        array_unshift($tsArray, '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:common/Configuration/TypoScript/plugin.typoscript">');
        //修改config的数据
        $this->updateValue([ 'config'=>implode(chr(10), $tsArray)], 'sys_template', [ 'uid' => 1 ]);
        //################################switch template end################################

        //TYPO3_CONF_VARS Config
        if(!empty($_POST['TYPO3_CONF_VARS'])){
            $configurationManager = $this->objectManager->get(\TYPO3\CMS\Core\Configuration\ConfigurationManager::class);
            $configurationManager->updateLocalConfiguration($_POST['TYPO3_CONF_VARS']);
        }
        if(!empty($fileConfArr)){
            $configurationManager = $this->objectManager->get(\TYPO3\CMS\Core\Configuration\ConfigurationManager::class);
            $configurationManager->updateLocalConfiguration($fileConfArr);
        }
        
        if(!empty($errorArray)){
            foreach($errorArray as $error){
                $this->addFlashMessage($error, '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            }
        }else{
            $this->addFlashMessage('配置更新成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        }
        
        $CacheManager = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Cache\CacheManager::class);
        $CacheManager->flushCachesInGroup('pages');
        
        $this->redirect('list');
    }
    
    /**
     * 异步请求
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-18
     */
    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');
        if ($cmd=='transtest') {
            $text = $this->translate(array(
                'app_key' => GeneralUtility::_GP('app_key'),
                'sec_key' => GeneralUtility::_GP('sec_key'),
                'query'   => GeneralUtility::_GP('query'),
                'from'    => 'auto',
                'to'      => GeneralUtility::_GP('to')
            ));
            JSON(array(
                'code' => 1,
                'message' => '执行成功!',
                'text' => $text,
            ));
        }
        JSON(array(
            'code' => 0,
            'message' => '没有可执行的动作'
        ));
    }

    /**
     * 获取数据
     *
     * @param [type] $field
     * @param [type] $table
     * @param [type] $where
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    private function getValue($field, $table, $where){
        $result = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable($table)
        ->select(
            $field, // array fields to select 
            $table, // from
            $where // array where
        )
        ->fetch();
        return $result;
    }

    /**
     * 更新数据
     *
     * @param [type] $field
     * @param [type] $table
     * @param [type] $where
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    private function updateValue($field, $table, $where){
        $result = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable($table)
        ->update(
            $table, // from
            $field, // array set
            $where  // array where
        );
        return ;
    }

    public function uploadForFtp($file,$path='public',$filename='')
    {
        //配置
        $config = $GLOBALS['TYPO3_CONF_VARS']['FTP'];
        $ftp = new \Sll\Common\Library\Ftp($config);
        if ($this->extensionName!='Common') {
            $filename = ($config['rename']==1) ? ($this->msectime().'.'.end(explode('.', $file['name']))) : $file['name'];
            $savedir = ($path!='') ? ($path.'/'.date('Y-m')) : date('Y-m') ;
        } else {
            $savedir = $path;
        }
        
        $savepath = '/erpfile/'.$savedir;
        $rootpath = $ftp->checkAndCreatePath($savepath);
        $data =array(
            'rootpath'=>$rootpath,
            'savepath'=>$savedir,
            'savename'=>$filename
        );
        $info = array_merge($file,$data);
        $upinfo = $ftp->save($info);
        if($upinfo){
            //成功处理逻辑
            return array(
                'name' => $file['name'],
                'rename' => $filename,
                'original' => $savedir.'/'.$filename,
                'thumbnail' => $savedir.'/'.$filename,
            );
        }else{
            //失败处理逻辑
            return false;
        }
    }

    /**
     * 翻译
     *
     * @param array $data
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-18
     */
    public function translate($data=array())
    {
        require_once (ExtensionManagementUtility::extPath('common') . 'Classes/Library/translate.php');
        $trans = new \Sll\Common\Library\Translate(['app_key' => $data['app_key'],'sec_key' => $data['sec_key']]);
        
        $ret = $trans->do_request($data['query'],$data['from'],$data['to']);
        $ret = json_decode($ret, true);
        if ($ret['errorCode']==0) return $ret['translation'][0];
        return '暂未找到翻译: '.$data['query'];
    }

    /**
     * 返回当前的毫秒时间戳
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-11
     */
    public function msectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}
