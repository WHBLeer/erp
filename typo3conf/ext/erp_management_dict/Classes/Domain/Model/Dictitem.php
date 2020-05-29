<?php
namespace ERP\ErpManagementDict\Domain\Model;


/***
 *
 * This file is part of the "类别" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 类别
 */
class Dictitem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
     * 所属类目
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dicttype
     */
    protected $dicttype = null;

    /**
     * Returns the name
     * 
     * @return string $name
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
     * @return string $code
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

    /**
     * Returns the dicttype
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype
     */
    public function getDicttype()
    {
        return $this->dicttype;
    }

    /**
     * Sets the dicttype
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype
     * @return void
     */
    public function setDicttype(\ERP\ErpManagementDict\Domain\Model\Dicttype $dicttype)
    {
        $this->dicttype = $dicttype;
    }
}
