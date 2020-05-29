<?php
namespace ERP\ErpManagementWallet\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RecordTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWallet\Domain\Model\Record
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementWallet\Domain\Model\Record();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getSuccessTimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSuccessTime()
        );
    }

    /**
     * @test
     */
    public function setSuccessTimeForIntSetsSuccessTime()
    {
        $this->subject->setSuccessTime(12);

        self::assertAttributeEquals(
            12,
            'successTime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAmountReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getAmount()
        );
    }

    /**
     * @test
     */
    public function setAmountForFloatSetsAmount()
    {
        $this->subject->setAmount(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'amount',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getSerialNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSerialNumber()
        );
    }

    /**
     * @test
     */
    public function setSerialNumberForStringSetsSerialNumber()
    {
        $this->subject->setSerialNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'serialNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOrderNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOrderNumber()
        );
    }

    /**
     * @test
     */
    public function setOrderNumberForStringSetsOrderNumber()
    {
        $this->subject->setOrderNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'orderNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPaymentReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPayment()
        );
    }

    /**
     * @test
     */
    public function setPaymentForIntSetsPayment()
    {
        $this->subject->setPayment(12);

        self::assertAttributeEquals(
            12,
            'payment',
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
    public function getBilltypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getBilltype()
        );
    }

    /**
     * @test
     */
    public function setBilltypeForIntSetsBilltype()
    {
        $this->subject->setBilltype(12);

        self::assertAttributeEquals(
            12,
            'billtype',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRemarkReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRemark()
        );
    }

    /**
     * @test
     */
    public function setRemarkForStringSetsRemark()
    {
        $this->subject->setRemark('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'remark',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCountryReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setCountryForRegionSetsCountry()
    {
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
