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
     * @param $keyword
     */
    public function findAlls($keyword = '')
    {
        $query = $this->createQuery();
        $query->matching($query->equals('uid', $uid));
        return $query->execute()->getFirst();
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
