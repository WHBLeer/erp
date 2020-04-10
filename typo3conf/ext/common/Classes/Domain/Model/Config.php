<?php
namespace Sll\Common\Domain\Model;


/***
 *
 * This file is part of the "通用配置" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * Config
 */
class Config extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 页面图标
     * 
     * @var string
     */
    protected $icon = '';

    /**
     * SVG页面图标
     * 
     * @var string
     */
    protected $svgIcon = '';

    /**
     * Returns the icon
     * 
     * @return string $icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the icon
     * 
     * @param string $icon
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Returns the svgIcon
     * 
     * @return string $svgIcon
     */
    public function getSvgIcon()
    {
        return $this->svgIcon;
    }

    /**
     * Sets the svgIcon
     * 
     * @param string $svgIcon
     * @return void
     */
    public function setSvgIcon($svgIcon)
    {
        $this->svgIcon = $svgIcon;
    }
}
