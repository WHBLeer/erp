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
 * AddressController
 */
class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * addressRepository
     * 
     * @var \ERP\ErpManagementOrder\Domain\Repository\AddressRepository
     * @inject
     */
    protected $addressRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $addresses = $this->addressRepository->findAll();
        $this->view->assign('addresses', $addresses);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @return void
     */
    public function showAction(\ERP\ErpManagementOrder\Domain\Model\Address $address)
    {
        $this->view->assign('address', $address);
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
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $newAddress
     * @return void
     */
    public function createAction(\ERP\ErpManagementOrder\Domain\Model\Address $newAddress)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->addressRepository->add($newAddress);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @ignorevalidation $address
     * @return void
     */
    public function editAction(\ERP\ErpManagementOrder\Domain\Model\Address $address)
    {
        $this->view->assign('address', $address);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @return void
     */
    public function updateAction(\ERP\ErpManagementOrder\Domain\Model\Address $address)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->addressRepository->update($address);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementOrder\Domain\Model\Address $address)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->addressRepository->remove($address);
        $this->redirect('list');
    }

    public function saveAddress($data=[])
    {
        if (isset($data['uid'])) {
            $address = $this->addressRepository->findByUid($data['uid']);
            $function = 'update';
        } else {
            $address = new \ERP\ErpManagementOrder\Domain\Model\Address;
            $function = 'add';
        }
        $address->setName($data['name']);
        $address->setTelephone($data['telephone']);
        $address->setPostcode($data['postcode']);
        $address->setState($data['state']);
        $address->setCity($data['city']);
        $address->setStreetNumber($data['streetnumber']);
        $address->setAddress($data['address']);
        $address = $this->addressRepository->$function($address);
        return $address;
    }
}
