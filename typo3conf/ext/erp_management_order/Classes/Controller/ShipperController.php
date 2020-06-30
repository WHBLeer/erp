<?php
namespace ERP\ErpManagementOrder\Controller;


/***
 *
 * This file is part of the "订单管理系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * ShipperController
 */
class ShipperController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * shipperRepository
     * 
     * @var \ERP\ErpManagementOrder\Domain\Repository\ShipperRepository
     * @inject
     */
    protected $shipperRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $shippers = $this->shipperRepository->findAll();
        $this->view->assign('shippers', $shippers);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @return void
     */
    public function showAction(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper)
    {
        $this->view->assign('shipper', $shipper);
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
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $newShipper
     * @return void
     */
    public function createAction(\ERP\ErpManagementOrder\Domain\Model\Shipper $newShipper)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->shipperRepository->add($newShipper);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @ignorevalidation $shipper
     * @return void
     */
    public function editAction(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper)
    {
        $this->view->assign('shipper', $shipper);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @return void
     */
    public function updateAction(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->shipperRepository->update($shipper);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->shipperRepository->remove($shipper);
        $this->redirect('list');
    }

    public function saveShipper($data=[])
    {
        if (isset($data['uid'])) {
            $shipper = $this->ShipperRepository->findByUid($data['uid']);
            $function = 'update';
        } else {
            $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper;
            $function = 'add';
        }
        $shipper->setNameZh($data['NameZh']);
        $shipper->setNameEn($data['NameEn']);
        $shipper->setSku($data['Sku']);
        $shipper->setNumber($data['Number']);
        $shipper->setWeight($data['Weight']);
        $shipper->setLength($data['Length']);
        $shipper->setWidth($data['Width']);
        $shipper->setHeight($data['Height']);
        $shipper->setEmail($data['Email']);
        $shipper->setRoute($data['Route']);
        $shipper->setProviders($data['Providers']);
        $shipper->setGnWaybill($data['GnWaybill']);
        $shipper->setGnTracking($data['GnTracking']);
        $shipper->setGnStatus($data['GnStatus']);
        $shipper->setGjWaybill($data['GjWaybill']);
        $shipper->setGjTracking($data['GjTracking']);
        $shipper->setGjStatus($data['GjStatus']);
        $shipper->setDeliveryType($data['DeliveryType']);
        $shipper->setRemark($data['Remark']);
        $shipper->setCustomermail($data['Customermail']);
        $shipper->setLogs($data['Logs']);
        // $shipper->setReissue = null;
        $shipper = $this->shipperRepository->$function($shipper);
        return $shipper;
    }
}
