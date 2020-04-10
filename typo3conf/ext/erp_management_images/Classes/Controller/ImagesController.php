<?php
namespace ERP\ErpManagementImages\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

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
 * ImagesController
 */
class ImagesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistanceManager = null;

    /**
     * imagesRepository
     * 
     * @var \ERP\ErpManagementImages\Domain\Repository\ImagesRepository
     * @inject
     */
    protected $imagesRepository = null;

    /**
     * action list
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function listAction()
    {
        $images = $this->imagesRepository->findAll();
        $this->view->assign('images', $images);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function showAction(\ERP\ErpManagementImages\Domain\Model\Images $images)
    {
        $this->view->assign('image', $image);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function createAction(\ERP\ErpManagementImages\Domain\Model\Images $images)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->imagesRepository->add($image);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @ignorevalidation $images
     * @return void
     */
    public function editAction(\ERP\ErpManagementImages\Domain\Model\Images $images)
    {
        $this->view->assign('image', $image);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function updateAction(\ERP\ErpManagementImages\Domain\Model\Images $images)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->imagesRepository->update($image);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementImages\Domain\Model\Images $images)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->imagesRepository->remove($image);
        $this->redirect('list');
    }

    /**
     * 文件接口处理
     * 
     * @author wanghongbin
     * @param ERP\ErpManagementImagess\Domain\Model\Imagess
     * @return void
     */
    public function filesAction()
    {
        // file_put_contents('getjosn.log', date('Y-m-d H:i:s') . '==_POST==' . \json_encode($_POST) . chr(10) . chr(10), FILE_APPEND | LOCK_EX);
        $cmd = GeneralUtility::_GP('cmd');
        if ($cmd == 'f_upload') {
            $file = $_FILES['file_data'];
            $res = $this->uploadForFtp($file,'product');
            if (!$res==false) {
                $res['size'] = $file['size'];
                $data = $this->addData($res);
                die(\json_encode(['code' => 1, 'message' => '图片已上传！','uid' => $data]));
            } else {
                die(\json_encode(['code' => 0, 'message' => '图片上传失败！']));
            }
        }
        if ($cmd == 'f_delete') {
            $res = $this->delData(GeneralUtility::_GP('uid'));
            if (!$res==false) {
                die(\json_encode(['code' => 1, 'message' => '图片删除成功！']));
            } else {
                die(\json_encode(['code' => 0, 'message' => '图片删除失败！']));
            }
        }
        die(\json_encode(['code' => 0, 'message' => 'ERROR!!! No Result!']));
    }

    public function addData($data)
    {
        $file = new \ERP\ErpManagementImages\Domain\Model\Images();
        $file->setName($data['name']);//名称
        $file->setReName($data['rename']);//重命名
        $file->setOriginal($data['original']);//原图链接
        $file->setThumbnail($data['thumbnail']);//缩略图链接  
        $file->setSize($data['size']);//缩略图链接  
        $this->imagesRepository->add($file);  
        $this->persistanceManager->persistAll();
        return $file->getUid();
    }

    public function delData($uid)
    {
        $file = $this->imagesRepository->findByUid($uid); 
        $res = $this->removeForFtp($file->getOriginal());
        if (!$res==false) {
            $this->imagesRepository->remove($file);
            $this->persistanceManager->persistAll();
            return true;
        }
        return false;
    }

    public function uploadForFtp($file,$path='public')
    {
        require_once (ExtensionManagementUtility::extPath('common') . 'Classes/Library/ftp.php');
        //配置
        $config = $GLOBALS['TYPO3_CONF_VARS']['FTP'];
        $ftp = new \Sll\Common\Library\Ftp($config);
        $filename = ($config['rename']==1) ? ($this->msectime().'.'.end(explode('.', $file['name']))) : $file['name'];
        $savedir = ($path!='') ? ($path.'/'.date('Y-m')) : date('Y-m') ;
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

    public function removeForFtp($file)
    {
        require_once (ExtensionManagementUtility::extPath('common') . 'Classes/Library/ftp.php');
        //配置
        $config = $GLOBALS['TYPO3_CONF_VARS']['FTP'];
        $ftp = new \Sll\Common\Library\Ftp($config);
        $ftp->checkRootPath('erpfile');
        return $ftp->remove($file);
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
