<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class LogisticsTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Domain\Model\Logistics
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDomesticWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDomesticWaybill()
        );
    }

    /**
     * @test
     */
    public function setDomesticWaybillForStringSetsDomesticWaybill()
    {
        $this->subject->setDomesticWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'domesticWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getInternationalWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getInternationalWaybill()
        );
    }

    /**
     * @test
     */
    public function setInternationalWaybillForStringSetsInternationalWaybill()
    {
        $this->subject->setInternationalWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'internationalWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEstimateFreightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getEstimateFreight()
        );
    }

    /**
     * @test
     */
    public function setEstimateFreightForFloatSetsEstimateFreight()
    {
        $this->subject->setEstimateFreight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'estimateFreight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getActualFreightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getActualFreight()
        );
    }

    /**
     * @test
     */
    public function setActualFreightForFloatSetsActualFreight()
    {
        $this->subject->setActualFreight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'actualFreight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getAgingReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getAging()
        );
    }

    /**
     * @test
     */
    public function setAgingForIntSetsAging()
    {
        $this->subject->setAging(12);

        self::assertAttributeEquals(
            12,
            'aging',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWeightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getWeight()
        );
    }

    /**
     * @test
     */
    public function setWeightForFloatSetsWeight()
    {
        $this->subject->setWeight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'weight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getLengthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLength()
        );
    }

    /**
     * @test
     */
    public function setLengthForIntSetsLength()
    {
        $this->subject->setLength(12);

        self::assertAttributeEquals(
            12,
            'length',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWidthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getWidth()
        );
    }

    /**
     * @test
     */
    public function setWidthForIntSetsWidth()
    {
        $this->subject->setWidth(12);

        self::assertAttributeEquals(
            12,
            'width',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHeightReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getHeight()
        );
    }

    /**
     * @test
     */
    public function setHeightForIntSetsHeight()
    {
        $this->subject->setHeight(12);

        self::assertAttributeEquals(
            12,
            'height',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getQuantityReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getQuantity()
        );
    }

    /**
     * @test
     */
    public function setQuantityForIntSetsQuantity()
    {
        $this->subject->setQuantity(12);

        self::assertAttributeEquals(
            12,
            'quantity',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGoodstypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGoodstype()
        );
    }

    /**
     * @test
     */
    public function setGoodstypeForIntSetsGoodstype()
    {
        $this->subject->setGoodstype(12);

        self::assertAttributeEquals(
            12,
            'goodstype',
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
