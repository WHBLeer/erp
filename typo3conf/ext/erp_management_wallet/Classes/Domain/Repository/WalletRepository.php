<?php
namespace ERP\ErpManagementWallet\Domain\Repository;


/***
 *
 * This file is part of the "钱包模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * The repository for Wallets
 */
class WalletRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }
    
    /**
     * 查询用户钱包信息
     *
     * @param [type] $userid
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-20
     */
    public function findByUser($userid)
    {
        $query = $this->createQuery();
        $condition = array();
        $condition[] = $query->equals('erpuser.uid', $userid);
        $query->matching($query->logicalAnd($condition));
        $result = $query->execute();
        if ($result->count() > 0) {
            return $result->getFirst();
        }
        return null;
    }
}
