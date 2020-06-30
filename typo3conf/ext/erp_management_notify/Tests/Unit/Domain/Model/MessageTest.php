<?php
namespace ERP\ErpManagementNotify\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class MessageTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementNotify\Domain\Model\Message
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementNotify\Domain\Model\Message();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getMsgTypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getMsgType()
        );
    }

    /**
     * @test
     */
    public function setMsgTypeForIntSetsMsgType()
    {
        $this->subject->setMsgType(12);

        self::assertAttributeEquals(
            12,
            'msgType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReTypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getReType()
        );
    }

    /**
     * @test
     */
    public function setReTypeForIntSetsReType()
    {
        $this->subject->setReType(12);

        self::assertAttributeEquals(
            12,
            'reType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBodytextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBodytext()
        );
    }

    /**
     * @test
     */
    public function setBodytextForStringSetsBodytext()
    {
        $this->subject->setBodytext('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'bodytext',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSendtimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSendtime()
        );
    }

    /**
     * @test
     */
    public function setSendtimeForIntSetsSendtime()
    {
        $this->subject->setSendtime(12);

        self::assertAttributeEquals(
            12,
            'sendtime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSenderReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSender()
        );
    }

    /**
     * @test
     */
    public function setSenderForIntSetsSender()
    {
        $this->subject->setSender(12);

        self::assertAttributeEquals(
            12,
            'sender',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReceiverReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getReceiver()
        );
    }

    /**
     * @test
     */
    public function setReceiverForStringSetsReceiver()
    {
        $this->subject->setReceiver('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'receiver',
            $this->subject
        );
    }
}
