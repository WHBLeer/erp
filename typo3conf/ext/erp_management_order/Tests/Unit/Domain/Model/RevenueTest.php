<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RevenueTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Domain\Model\Revenue
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementOrder\Domain\Model\Revenue();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getOrderAmountReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getOrderAmount()
        );
    }

    /**
     * @test
     */
    public function setOrderAmountForFloatSetsOrderAmount()
    {
        $this->subject->setOrderAmount(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'orderAmount',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getCommissionReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getCommission()
        );
    }

    /**
     * @test
     */
    public function setCommissionForFloatSetsCommission()
    {
        $this->subject->setCommission(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'commission',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getArriveReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getArrive()
        );
    }

    /**
     * @test
     */
    public function setArriveForFloatSetsArrive()
    {
        $this->subject->setArrive(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'arrive',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getCostAmountReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getCostAmount()
        );
    }

    /**
     * @test
     */
    public function setCostAmountForFloatSetsCostAmount()
    {
        $this->subject->setCostAmount(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'costAmount',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getFreightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getFreight()
        );
    }

    /**
     * @test
     */
    public function setFreightForFloatSetsFreight()
    {
        $this->subject->setFreight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'freight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getServiceFeeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getServiceFee()
        );
    }

    /**
     * @test
     */
    public function setServiceFeeForFloatSetsServiceFee()
    {
        $this->subject->setServiceFee(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'serviceFee',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getProfitReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getProfit()
        );
    }

    /**
     * @test
     */
    public function setProfitForFloatSetsProfit()
    {
        $this->subject->setProfit(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'profit',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getProfitMarginReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getProfitMargin()
        );
    }

    /**
     * @test
     */
    public function setProfitMarginForFloatSetsProfitMargin()
    {
        $this->subject->setProfitMargin(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'profitMargin',
            $this->subject,
            '',
            0.000000001
        );
    }
}
