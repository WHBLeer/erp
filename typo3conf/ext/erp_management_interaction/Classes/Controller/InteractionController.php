<?php
namespace ERP\ErpManagementInteraction\Controller;

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
 * InteractionController
 */
class InteractionController extends CommonController
{
    /**
     * action ajax
     * 
     * @param ERP\ErpManagementInteraction\Domain\Model\Interaction
     * @return void
     */
    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');
        // 用户session校验
        if (isset($cmd)){
            if ($cmd=='user_info') {
                JSON($this->user_info());
            }

            // 淘宝采集
            if ($cmd=='collection_tb') {
                $result = $this->collection_tb();
                JSON($result);
            }

            // 天猫采集
            if ($cmd=='collection_tm') {
                $result = $this->collection_tm();
                JSON($result);
            }

            // 1688采集
            if ($cmd=='collection_1688') {
                $params = array(
                    'source_url' => GeneralUtility::_GP("source_url"),
                    'datas' => GeneralUtility::_GP("datas"),
                );
                $result = $this->collection_1688($params);
                JSON($result);
            }
        }
        JSON($this->error_message);
    }

    /**
     * action callback
     * 
     * @param ERP\ErpManagementInteraction\Domain\Model\Interaction
     * @return void
     */
    public function callbackAction()
    {
    }

}
