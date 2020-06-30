<?php
namespace ERP\ErpManagementDict\Controller;


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
 * DicttypeController
 */
class DicttypeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * dicttypeRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\DicttypeRepository
     * @inject
     */
    protected $dicttypeRepository = null;

    /**
     * action list
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function listAction()
    {
        $dicttypes = $this->dicttypeRepository->findAll();
        $this->view->assign('dicttypes', $dicttypes);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function showAction(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->view->assign('dicttype', $dicttype);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function createAction(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dicttypeRepository->add($dicttype);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @ignorevalidation $dicttype
     * @return void
     */
    public function editAction(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->view->assign('dicttype', $dicttype);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function updateAction(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dicttypeRepository->update($dicttype);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementDict\Domain\Model\Dicttype
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->dicttypeRepository->remove($dicttype);
        $this->redirect('list');
    }
    /**
     * @param $uid
     */
    public function findByUid($uid)
    {
        return $this->dicttypeRepository->findByUid($uid);
    }

    /**
     * @param $uid
     */
    public function findByUids($uids)
    {
        return $this->dicttypeRepository->findByUids($uids);
    }
}
