<?php
namespace ERP\ErpManagementNotify\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ReceiveTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementNotify\Domain\Model\Receive
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementNotify\Domain\Model\Receive();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getUser()
        );
    }

    /**
     * @test
     */
    public function setUserForIntSetsUser()
    {
        $this->subject->setUser(12);

        self::assertAttributeEquals(
            12,
            'user',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGettimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGettime()
        );
    }

    /**
     * @test
     */
    public function setGettimeForIntSetsGettime()
    {
        $this->subject->setGettime(12);

        self::assertAttributeEquals(
            12,
            'gettime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReadtimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getReadtime()
        );
    }

    /**
     * @test
     */
    public function setReadtimeForIntSetsReadtime()
    {
        $this->subject->setReadtime(12);

        self::assertAttributeEquals(
            12,
            'readtime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus()
    {
        $this->subject->setStatus(12);

        self::assertAttributeEquals(
            12,
            'status',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMessageReturnsInitialValueForMessage()
    {
        self::assertEquals(
            null,
            $this->subject->getMessage()
        );
    }

    /**
     * @test
     */
    public function setMessageForMessageSetsMessage()
    {
        $messageFixture = new \ERP\ErpManagementNotify\Domain\Model\Message();
        $this->subject->setMessage($messageFixture);

        self::assertAttributeEquals(
            $messageFixture,
            'message',
            $this->subject
        );
    }
}
