<?php
namespace ERP\ErpManagementProduct\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
 * The repository for UserManagements
 */
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function findAllRange($start,$end,$user)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_erpmanagementproduct_domain_model_product');
        $statement = $queryBuilder
        ->select('uid')
        ->from('tx_erpmanagementproduct_domain_model_product')
        ->where(
            $queryBuilder->expr()->eq('approval.code', $queryBuilder->createNamedParameter(1)),
            $queryBuilder->expr()->eq('shelves.code', $queryBuilder->createNamedParameter(1)),
            $queryBuilder->expr()->eq('adduser', $queryBuilder->createNamedParameter($user)),
            $queryBuilder->expr()->gte('uid', $queryBuilder->createNamedParameter($start)),
            $queryBuilder->expr()->gte('uid', $queryBuilder->createNamedParameter($start)),
            $queryBuilder->expr()->lte('uid', $queryBuilder->createNamedParameter($end))
        )
        ->execute();
        return $statement->fetchAll();
    }
}
