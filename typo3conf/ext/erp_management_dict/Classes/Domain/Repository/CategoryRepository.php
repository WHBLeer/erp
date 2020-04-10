<?php
namespace ERP\ErpManagementDict\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
 * The repository for Categories
 */
class CategoryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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
    public function findFirstParent($keyword = '')
    {
        $query = $this->createQuery();
        $arr = array();
        $arr[] = $query->lessThanOrequal('uid', 24);
        $query->matching($query->logicalAnd($arr));
        $query->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        return $query->execute();
    }

    /**
     * 查询类别
     * 
     * @author wanghongbin
     * @param $pid
     * @return void
     */
    public function findCategory($pid = 0)
    {
        $datas = array();
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_erpmanagementdict_domain_model_category');
        $queryBuilder->addSelectLiteral("code,name,name_en,parent_id");
        $queryBuilder->from('tx_erpmanagementdict_domain_model_category');
        if ($pid != 0) {
            $queryBuilder->where($queryBuilder->expr()->eq('parent_id', $queryBuilder->createNamedParameter($pid)));
        } else {
            $queryBuilder->where($queryBuilder->expr()->lte('uid', $queryBuilder->createNamedParameter(24)));
        }
        $queryBuilder->orderBy('uid', "ASC");
        $datas = $queryBuilder->execute()->fetchAll();
        $category = array();
        for ($i = 0; $i < count($datas); $i++) {
            $category[] = array(
            'id' => $datas[$i]['code'], 
            'text' => $datas[$i]['name'] . ' ' . ' ' . $datas[$i]['name_en'], 
            'state' => ['opened' => true], 
            'checked' => false, 
            'attributes' => null, 
            'children' => [], 
            'parentId' => $datas[$i]['parent_id'], 
            'hasParent' => false, 
            'hasChildren' => true
            );
        }
        return $category;
    }

    /**
     * @param $id
     */
    public function getCategoryById($id)
    {
        $query = $this->createQuery();
        $arr = array();
        $arr[] = $query->equals('code', $id);
        $query->matching($query->logicalAnd($arr));
        return $query->execute()->getFirst();
    }
}
