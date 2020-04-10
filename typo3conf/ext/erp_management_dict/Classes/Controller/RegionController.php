<?php
namespace ERP\ErpManagementDict\Controller;


/***
 *
 * This file is part of the "数据字典" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * RegionController
 */
class RegionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * regionRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\RegionRepository
     * @inject
     */
    protected $regionRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $regions = $this->regionRepository->findAll();
        $this->view->assign('regions', $regions);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $region
     * @return void
     */
    public function showAction(\ERP\ErpManagementDict\Domain\Model\Region $region)
    {
        $this->view->assign('region', $region);
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
     * @param \ERP\ErpManagementDict\Domain\Model\Region $newRegion
     * @return void
     */
    public function createAction(\ERP\ErpManagementDict\Domain\Model\Region $newRegion)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->regionRepository->add($newRegion);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $region
     * @ignorevalidation $region
     * @return void
     */
    public function editAction(\ERP\ErpManagementDict\Domain\Model\Region $region)
    {
        $this->view->assign('region', $region);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $region
     * @return void
     */
    public function updateAction(\ERP\ErpManagementDict\Domain\Model\Region $region)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->regionRepository->update($region);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $region
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementDict\Domain\Model\Region $region)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->regionRepository->remove($region);
        $this->redirect('list');
    }
}
