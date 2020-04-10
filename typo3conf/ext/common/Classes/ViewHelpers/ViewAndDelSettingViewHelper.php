<?php
namespace Sll\Common\ViewHelpers;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Frans Saris <frans@beech.it>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
/**
 * ViewHelper for ViewAndDelSetting
 */
class ViewAndDelSettingViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $src
     */
    public function initializeArguments()
    {
        $this->registerArgument('uids', 'string', 'file data id', true);
    }
    
    /**
     * Go through all given classes which implement the mediainterface
     * and use the proper ones to render the media element
     *
     * @param string $src
     * @return int
     */
    public function render() {
        $uids = $this->arguments['uids'];
        if (!$uids==false) {
            $siteurl = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
            $fileurl = $GLOBALS['TYPO3_CONF_VARS']['FTP']['sever'];
            $uids = GeneralUtility::trimExplode(',', ltrim($uids,','));
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_erpmanagementimages_domain_model_images');
            $query = $queryBuilder
            ->add('select','uid,name,re_name,original,thumbnail,size')
            ->from('tx_erpmanagementimages_domain_model_images')
            ->where(
                $queryBuilder->expr()->in('uid',$uids)
            )
            ->execute();
            $rows = $query->fetchAll();
            
            if (count($rows)>0) {
                $str0 = '';$str1 = [];$str2 = [];
                for ($i=0; $i < count($rows); $i++) { 
                    $str1[] = '"' .$fileurl.$rows[$i]['original']. '"';
                    $str2[] = '{caption: "' .$rows[$i]['name']. '", size: ' .$rows[$i]['size']. ', width: "120px", key:' .$rows[$i]['uid']. ',extra: {uid: ' .$rows[$i]['uid']. '}}';
                }
                $str0 .= '
                var initialPreview = [
                    '.implode(',
                    ',$str1).'
                ];';
                $str0 .= '
                var initialPreviewConfig = [
                    '.implode(',
                    ',$str2).'
                ];';
                return $str0;
            } else {
                return 'var initialPreview = [];var initialPreviewConfig = [];';
            }
            
        } else {
            return 'var initialPreview = [];var initialPreviewConfig = [];';
        }
        
    }

}
