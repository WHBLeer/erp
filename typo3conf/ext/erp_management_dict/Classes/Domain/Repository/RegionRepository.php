<?php
namespace ERP\ErpManagementDict\Domain\Repository;


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
 * The repository for Regions
 */
class RegionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    // 使用方法1: 所有查询中使用
    public function initializeObject() {
        // 获取配置
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        // 修改设置
        $querySettings->setRespectStoragePage(FALSE); // 忽略数据存储id storagePid
        // 将设置保存为默认值
        $this->setDefaultQuerySettings($querySettings);
    }
}
