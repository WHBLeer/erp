<?php
namespace ERP\ErpManagementNotify\Domain\Repository;


/***
 *
 * This file is part of the "消息通知系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * The repository for Receives
 */
class ReceiveRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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
     * 查找用户的通知信息
     *
     * @param integer $user
     * @param integer $read -1:全部 0:未读 1:已读
     * @param string $keyword
     * @param integer $timest
     * @param integer $timeed
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-08
     */
    public function findByUser($user=0,$read=-1,$keyword='',$timest=0,$timeed=0)
    {
        $query = $this->createQuery();
        $condition = array();
        $condition[] = $query->equals('user', $user);
        if ($read!=-1) $condition[] = $query->equals('status', $read);
        if ($keyword!='') {
            $condition[] = $query->logicalOr(array(
                $query->like('message.title','%'.$keyword.'%'),
                $query->like('message.bodytext','%'.$keyword.'%')
            ));
        }
        if ($timest>0) {
            $condition[] = $query->greaterThanOrequal('message.sendtime', $timest);
        }
        if ($timeed>0) {
            $condition[] = $query->lessThanOrequal('message.sendtime', $timeed);
        }
        
        $query->matching($query->logicalAnd($condition));
        $query->setOrderings(array(
            'gettime' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING)
        );
        return $query->execute();
    }
}
