<?php
namespace ERP\ErpManagementWorkorder\Domain\Model;


/***
 *
 * This file is part of the "工单模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * Dialogue
 */
class Dialogue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 内容描述
     * 
     * @var string
     */
    protected $bodytext = '';

    /**
     * 类型 0问题 1答复
     * 
     * @var string
     */
    protected $type = '';

    /**
     * Returns the bodytext
     * 
     * @return string $bodytext
     */
    public function getBodytext()
    {
        return $this->bodytext;
    }

    /**
     * Sets the bodytext
     * 
     * @param string $bodytext
     * @return void
     */
    public function setBodytext($bodytext)
    {
        $this->bodytext = $bodytext;
    }

    /**
     * Returns the type
     * 
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     * 
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
