<?php
namespace ERP\ErpManagementDict\Domain\Model;


/***
 *
 * This file is part of the "类目" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 类目
 */
class Dicttype extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 代码
     * 
     * @var string
     */
    protected $code = '';

    /**
     * Returns the name
     * 
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the code
     * 
     * @return string code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the code
     * 
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
}
