<?php
namespace ERP\ErpManagementUser\Domain\Repository;


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
 * The repository for ErpUsers
 */
class ErpUserRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * 根据字典类别，查询项目
     * 
     * @param unknown $parent
     */
    public function findAll($keyword = '')
    {
        $query = $this->createQuery();
        $arr = array();
        $arr[] = $query->lessThanOrequal('uid', 24);
        $query->matching($query->logicalAnd($arr));
        $query->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        return $query->execute();
    }

    /**
     * 根据用户id查询用户
     * 
     * @param string $authcode
     * @author wanghongbin
     * @return void
     */
    public function findByAuthcode($authcode = '')
    {
        $query = $this->createQuery();
        $condition = array();
        $condition[] = $query->equals('account_id', $authcode);
        $query->matching($query->logicalAnd($condition));
        $res = $query->execute();
        if ($res->count() > 0) {
            return $res->getFirst();
        }
        return null;
    }
}
