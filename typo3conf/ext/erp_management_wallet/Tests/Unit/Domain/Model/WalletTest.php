<?php
namespace ERP\ErpManagementWallet\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class WalletTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWallet\Domain\Model\Wallet
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementWallet\Domain\Model\Wallet();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getWalletNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWalletNumber()
        );
    }

    /**
     * @test
     */
    public function setWalletNumberForStringSetsWalletNumber()
    {
        $this->subject->setWalletNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'walletNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBalanceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getBalance()
        );
    }

    /**
     * @test
     */
    public function setBalanceForFloatSetsBalance()
    {
        $this->subject->setBalance(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'balance',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getPasswordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPassword()
        );
    }

    /**
     * @test
     */
    public function setPasswordForStringSetsPassword()
    {
        $this->subject->setPassword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'password',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAlipayReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAlipay()
        );
    }

    /**
     * @test
     */
    public function setAlipayForStringSetsAlipay()
    {
        $this->subject->setAlipay('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'alipay',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWxpayReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWxpay()
        );
    }

    /**
     * @test
     */
    public function setWxpayForStringSetsWxpay()
    {
        $this->subject->setWxpay('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'wxpay',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLogReturnsInitialValueForLog()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLog()
        );
    }

    /**
     * @test
     */
    public function setLogForObjectStorageContainingLogSetsLog()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();
        $objectStorageHoldingExactlyOneLog = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLog->attach($log);
        $this->subject->setLog($objectStorageHoldingExactlyOneLog);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneLog,
            'log',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addLogToObjectStorageHoldingLog()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();
        $logObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($log));
        $this->inject($this->subject, 'log', $logObjectStorageMock);

        $this->subject->addLog($log);
    }

    /**
     * @test
     */
    public function removeLogFromObjectStorageHoldingLog()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();
        $logObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($log));
        $this->inject($this->subject, 'log', $logObjectStorageMock);

        $this->subject->removeLog($log);
    }

    /**
     * @test
     */
    public function getRecordReturnsInitialValueFor()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getRecord()
        );
    }

    /**
     * @test
     */
    public function setRecordForObjectStorageContainingSetsRecord()
    {
        $record = new ();
        $objectStorageHoldingExactlyOneRecord = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneRecord->attach($record);
        $this->subject->setRecord($objectStorageHoldingExactlyOneRecord);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneRecord,
            'record',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addRecordToObjectStorageHoldingRecord()
    {
        $record = new ();
        $recordObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $recordObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($record));
        $this->inject($this->subject, 'record', $recordObjectStorageMock);

        $this->subject->addRecord($record);
    }

    /**
     * @test
     */
    public function removeRecordFromObjectStorageHoldingRecord()
    {
        $record = new ();
        $recordObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $recordObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($record));
        $this->inject($this->subject, 'record', $recordObjectStorageMock);

        $this->subject->removeRecord($record);
    }

    /**
     * @test
     */
    public function getErpuserReturnsInitialValueForErpUser()
    {
    }

    /**
     * @test
     */
    public function setErpuserForErpUserSetsErpuser()
    {
    }
}
