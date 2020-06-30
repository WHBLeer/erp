<?php
namespace ERP\ErpManagementNotify\Domain\Model;


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
 * 用户管理
 */
class Message extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 通知类型
     * 0:未指定
     * 1:公告
     * 2:提醒
     * 3:站内信
     * 
     * @var int
     */
    protected $msgType = 0;

    /**
     * 接收类型
     * 0:所有系统用户接收
     * 1:指定用户组接收
     * 2:选中部分用户接收
     * 3:指定用户接收
     * 
     * @var int
     */
    protected $reType = 0;

    /**
     * 通知名称
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 通知内容
     * 
     * @var string
     */
    protected $bodytext = '';

    /**
     * 发送时间
     * 
     * @var int
     */
    protected $sendtime = 0;

    /**
     * 发送者
     * 
     * @var int
     */
    protected $sender = 0;

    /**
     * 接收者,按照类型进行存储,存储选中用户时用户以','分隔
     * 
     * @var string
     */
    protected $receiver = '';

    /**
     * Returns the msgType
     * 
     * @return int $msgType
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * Sets the msgType
     * 
     * @param int $msgType
     * @return void
     */
    public function setMsgType($msgType)
    {
        $this->msgType = $msgType;
    }

    /**
     * Returns the reType
     * 
     * @return int $reType
     */
    public function getReType()
    {
        return $this->reType;
    }

    /**
     * Sets the reType
     * 
     * @param int $reType
     * @return void
     */
    public function setReType($reType)
    {
        $this->reType = $reType;
    }

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

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
     * Returns the sendtime
     * 
     * @return int $sendtime
     */
    public function getSendtime()
    {
        return $this->sendtime;
    }

    /**
     * Sets the sendtime
     * 
     * @param int $sendtime
     * @return void
     */
    public function setSendtime($sendtime)
    {
        $this->sendtime = $sendtime;
    }

    /**
     * Returns the sender
     * 
     * @return int $sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets the sender
     * 
     * @param int $sender
     * @return void
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * Returns the receiver
     * 
     * @return string $receiver
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver
     * 
     * @param string $receiver
     * @return void
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }
}
