<?php
namespace ERP\ErpManagementOrder\Domain\Repository;


/***
 *
 * This file is part of the "订单管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * The repository for UserManagements
 */
class OrderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    // public function initializeObject() {
    //     /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
    //     $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
    //     // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details
    //     // don't add the pid constraint
    //     $querySettings->setRespectStoragePage(FALSE);
    //     // set the storagePids to respect
    //     $querySettings->setStoragePageIds(array(1, 26, 989));
    //     // don't add fields from enablecolumns constraint
    //     // this function is deprecated!
    //     $querySettings->setRespectEnableFields(FALSE);
    //     // define the enablecolumn fields to be ignored
    //     // if nothing else is given, all enableFields are ignored
    //     $querySettings->setIgnoreEnableFields(TRUE);
    //     // define single fields to be ignored
    //     $querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));
    //     // add deleted rows to the result
    //     $querySettings->setIncludeDeleted(TRUE);
    //     // don't add sys_language_uid constraint
    //     $querySettings->setRespectSysLanguage(FALSE);
    //     // perform translation to dedicated language
    //     $querySettings->setSysLanguageUid(42);
    //     $this->setDefaultQuerySettings($querySettings);
    // }
    // // Example for a function setup changing query settings
    // public function findSomething() {
    //     $query = $this->createQuery();
    //     // don't add the pid constraint
    //     $query->getQuerySettings()->setRespectStoragePage(FALSE);
    //     // the same functions as shown in initializeObject can be applied.
    //     return $query->execute();
    // } 
    /**
     * 查询订单
     *
     * @param array $keywords
     * @return void
     * @author wanghongbin
     * tstamp: 2020-07-06
     */
    public function findAlls($keywords = array())
    {
        $query = $this->createQuery();
        $condition = [];
        if ($keywords['country']!='') {
            $condition[] = $query->equals('salesChannelName', $keywords['country']);
        }
        if ($keywords['orderStatus']!='') {
            $condition[] = $query->equals('orderStatus', $keywords['orderStatus']);
        }
        if ($keywords['payment']!='') {
            $condition[] = $query->equals('paymentMethod', $keywords['payment']);
        }
        if ($keywords['gnShipper']!='') {
            $condition[] = $query->equals('shipper.gnStatus', $keywords['gnShipper']);
        }
        if ($keywords['gjShipper']!='') {
            $condition[] = $query->equals('shipper.gjStatus', $keywords['gjShipper']);
        }
        if ($keywords['abnormal']!='') {
            $condition[] = $query->equals('orderStatus', $keywords['abnormal']);
        }
        if ($keywords['amazonid']!='') {
            $condition[] = $query->equals('amazonOrderId', $keywords['amazonid']);
        }
        if ($keywords['orderuid']!='') {
            $condition[] = $query->equals('uid', $keywords['orderuid']);
        }
        if ($keywords['gnWaybill']!='') {
            $condition[] = $query->equals('shipper.gnWaybill', $keywords['gnWaybill']);
        }
        if ($keywords['gjWaybill']!='') {
            $condition[] = $query->equals('shipper.gjWaybill', $keywords['gjWaybill']);
        }
        if ($keywords['gjTracking']!='') {
            $condition[] = $query->equals('shipper.gjTracking', $keywords['gjTracking']);
        }
        if ($keywords['productSku']!='') {
            $condition[] = $query->equals('shipper.sku', $keywords['productSku']);
        }
        if ($keywords['starttime']!='') {
            $condition[] = $query->greaterThanOrEqual('purchaseDate', $keywords['starttime']);
        }
        if ($keywords['endtime']!='') {
            $condition[] = $query->lessThanOrEqual('purchaseDate', $keywords['endtime']);
        }

        if (!empty($condition)) {
            $query->matching($query->logicalAnd($condition));
        }

        $query->setOrderings(
            [
                'purchaseDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                'lastUpdateDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            ]
        );
        return $query->execute();
    }

    /**
     * @param $keyword
     */
    public function findHiddenAll($keyword = '')
    {
        $query = $this->createQuery();

        // $query->getQuerySettings()->setRespectEnableFields(FALSE);
        $query->matching($query->equals('uid', $uid));
        return $query->execute()->getFirst();
    }

    /**
     * @param $uid
     */
    public function findHiddenByUid($uid)
    {
        $query = $this->createQuery();

        // $query->getQuerySettings()->setRespectEnableFields(FALSE);
        $query->matching($query->equals('uid', $uid));
        return $query->execute()->getFirst();
    }
}
