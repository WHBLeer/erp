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
 * 工单管理
 */
class Workorder extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 工单主题
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 工单类型
     * 
     * @var int
     */
    protected $worktype = 0;

    /**
     * 钱包动账记录
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $log = null;

    /**
     * 钱包交易记录表
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $record = null;

    /**
     * 数据所属
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

    /**
     * 工单关闭时间
     * 
     * @var int
     */
    protected $closetime = 0;

    /**
     * 联系人
     * 
     * @var string
     */
    protected $contact = '';

    /**
     * 联系人电话
     * 
     * @var string
     */
    protected $telephone = '';

    /**
     * 钱包交易记录表
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementWorkorder\Domain\Model\Dialogue>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $dialogue = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->dialogue = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the worktype
     * 
     * @return int $worktype
     */
    public function getWorktype()
    {
        return $this->worktype;
    }

    /**
     * Sets the worktype
     * 
     * @param int $worktype
     * @return void
     */
    public function setWorktype($worktype)
    {
        $this->worktype = $worktype;
    }

    /**
     * Adds a
     * 
     * @param $log
     * @return void
     */
    public function addLog($log)
    {
        $this->log->attach($log);
    }

    /**
     * Removes a
     * 
     * @param $logToRemove The  to be removed
     * @return void
     */
    public function removeLog($logToRemove)
    {
        $this->log->detach($logToRemove);
    }

    /**
     * Returns the log
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Sets the log
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $log
     * @return void
     */
    public function setLog(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $log)
    {
        $this->log = $log;
    }

    /**
     * Adds a
     * 
     * @param $record
     * @return void
     */
    public function addRecord($record)
    {
        $this->record->attach($record);
    }

    /**
     * Removes a
     * 
     * @param $recordToRemove The  to be removed
     * @return void
     */
    public function removeRecord($recordToRemove)
    {
        $this->record->detach($recordToRemove);
    }

    /**
     * Returns the record
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $record
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets the record
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $record
     * @return void
     */
    public function setRecord(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $record)
    {
        $this->record = $record;
    }

    /**
     * Returns the erpuser
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser
     */
    public function getErpuser()
    {
        return $this->erpuser;
    }

    /**
     * Sets the erpuser
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser
     * @return void
     */
    public function setErpuser(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser)
    {
        $this->erpuser = $erpuser;
    }

    /**
     * Returns the closetime
     * 
     * @return int $closetime
     */
    public function getClosetime()
    {
        return $this->closetime;
    }

    /**
     * Sets the closetime
     * 
     * @param int $closetime
     * @return void
     */
    public function setClosetime($closetime)
    {
        $this->closetime = $closetime;
    }

    /**
     * Returns the contact
     * 
     * @return string $contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Sets the contact
     * 
     * @param string $contact
     * @return void
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Returns the telephone
     * 
     * @return string $telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Sets the telephone
     * 
     * @param string $telephone
     * @return void
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Adds a Dialogue
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Dialogue $dialogue
     * @return void
     */
    public function addDialogue(\ERP\ErpManagementWorkorder\Domain\Model\Dialogue $dialogue)
    {
        $this->dialogue->attach($dialogue);
    }

    /**
     * Removes a Dialogue
     * 
     * @param \ERP\ErpManagementWorkorder\Domain\Model\Dialogue $dialogueToRemove The Dialogue to be removed
     * @return void
     */
    public function removeDialogue(\ERP\ErpManagementWorkorder\Domain\Model\Dialogue $dialogueToRemove)
    {
        $this->dialogue->detach($dialogueToRemove);
    }

    /**
     * Returns the dialogue
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementWorkorder\Domain\Model\Dialogue> $dialogue
     */
    public function getDialogue()
    {
        return $this->dialogue;
    }

    /**
     * Sets the dialogue
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementWorkorder\Domain\Model\Dialogue> $dialogue
     * @return void
     */
    public function setDialogue(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dialogue)
    {
        $this->dialogue = $dialogue;
    }
}
