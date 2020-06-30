<?php
namespace ERP\ErpManagementNotify\Domain\Model;


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
 * 接收人
 */
class Receive extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 接收人
     * 
     * @var int
     */
    protected $user = 0;

    /**
     * 接收时间戳
     * 
     * @var int
     */
    protected $gettime = 0;

    /**
     * 已读时间戳
     * 
     * @var int
     */
    protected $readtime = 0;

    /**
     * 通知内容
     * 
     * @var \ERP\ErpManagementNotify\Domain\Model\Message
     */
    protected $message = null;

    /**
     * 已读状态
     * 
     * @var int
     */
    protected $status = 0;

    /**
     * Returns the user
     * 
     * @return int $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     * 
     * @param int $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Returns the gettime
     * 
     * @return int $gettime
     */
    public function getGettime()
    {
        return $this->gettime;
    }

    /**
     * Sets the gettime
     * 
     * @param int $gettime
     * @return void
     */
    public function setGettime($gettime)
    {
        $this->gettime = $gettime;
    }

    /**
     * Returns the readtime
     * 
     * @return int $readtime
     */
    public function getReadtime()
    {
        return $this->readtime;
    }

    /**
     * Sets the readtime
     * 
     * @param int $readtime
     * @return void
     */
    public function setReadtime($readtime)
    {
        $this->readtime = $readtime;
    }

    /**
     * Returns the message
     * 
     * @return \ERP\ErpManagementNotify\Domain\Model\Message $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $message
     * @return void
     */
    public function setMessage(\ERP\ErpManagementNotify\Domain\Model\Message $message)
    {
        $this->message = $message;
    }

    /**
     * Returns the status
     * 
     * @return int $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     * 
     * @param int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
