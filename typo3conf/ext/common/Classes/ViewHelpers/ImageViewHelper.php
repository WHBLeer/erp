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
/**
 * eg
 * {sll:image(uids: product.imageuids,first: 'true')} 
 * <sll:image uids="{product.imageuids}" first="true" />
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
/**
* ViewHelper for ImageView
*/
class ImageViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * @var string
     */
    protected $tagName = 'img';

    /**
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     */
    protected $imageService;

    /**
     * @param \TYPO3\CMS\Extbase\Service\ImageService $imageService
     */
    public function injectImageService(\TYPO3\CMS\Extbase\Service\ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param string $src
     */
    public function initializeArguments()
    {
        $this->registerArgument('uids', 'string', 'file data id', true);
        $this->registerArgument('class', 'string', '样式属性');
        $this->registerArgument('width', 'int', '元素宽');
        $this->registerArgument('height', 'bool', '元素高');
        $this->registerArgument('events', 'array', '事件');
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
                $this->tag->addAttribute('class', (($this->arguments['class']!='') ? $this->arguments['class'] : 'image-view'));
                $this->tag->addAttribute('src', $fileurl.$rows[0]['original']);
                $this->tag->addAttribute('width', (($this->arguments['width']>0) ? $this->arguments['width'] : '80'));
                $this->tag->addAttribute('height', (($this->arguments['height']>0) ? $this->arguments['height'] : ''));
                $this->tag->addAttribute('alt', $rows[0]['name']);
                $this->tag->addAttribute('title', $rows[0]['name']);
                $events = $this->arguments['events'];
                foreach ($events as $key => $event) {
                    $this->tag->addAttribute($key, $event);
                }

                return $this->tag->render();
            } else {
                return null;
            }
            
        } else {
            return null;
        }
        
    }

}

