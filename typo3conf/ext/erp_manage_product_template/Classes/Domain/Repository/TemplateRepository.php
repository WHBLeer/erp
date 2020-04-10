<?php
namespace ERP\ErpManageProductTemplate\Domain\Repository;


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
class TemplateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * 列表
     * @param string keyword
     * 
     */
    public function findAlls($keyword = ''){
        
        $query = $this->createQuery();
		
		$con = array();
		
		if($keyword != ''){
			$con[] = $query->like('title','%'.$keyword.'%');
		}
        if(!empty($con)){
            $query->matching($query->logicalAnd($con));
        }
        
        $query->setOrderings(array(
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
        ));
        
		
        $result = $query->execute();
        return $result;
    }

    /**
     * news 列表
     * @param string keyword
     * 
     */
    public function findAllParent(){
        
        $query = $this->createQuery();
		
		$con = array();
		$con[] = $query->equals('parent',0);
		
        if(!empty($con)){
            $query->matching($query->logicalAnd($con));
        }
        
        $query->setOrderings(array(
            'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        ));
        
        $result = $query->execute();
        return $result;
    }
}
