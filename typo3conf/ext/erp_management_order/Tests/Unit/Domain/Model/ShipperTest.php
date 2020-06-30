<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ShipperTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Domain\Model\Shipper
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementOrder\Domain\Model\Shipper();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameZhReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNameZh()
        );
    }

    /**
     * @test
     */
    public function setNameZhForStringSetsNameZh()
    {
        $this->subject->setNameZh('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nameZh',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNameEnReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNameEn()
        );
    }

    /**
     * @test
     */
    public function setNameEnForStringSetsNameEn()
    {
        $this->subject->setNameEn('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nameEn',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSkuReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSku()
        );
    }

    /**
     * @test
     */
    public function setSkuForStringSetsSku()
    {
        $this->subject->setSku('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'sku',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNumberReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getNumber()
        );
    }

    /**
     * @test
     */
    public function setNumberForIntSetsNumber()
    {
        $this->subject->setNumber(12);

        self::assertAttributeEquals(
            12,
            'number',
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
    public function getLengthReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLength()
        );
    }

    /**
     * @test
     */
    public function setLengthForFloatSetsLength()
    {
        $this->subject->setLength(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'length',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getWidthReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getWidth()
        );
    }

    /**
     * @test
     */
    public function setWidthForFloatSetsWidth()
    {
        $this->subject->setWidth(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'width',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getHeightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getHeight()
        );
    }

    /**
     * @test
     */
    public function setHeightForFloatSetsHeight()
    {
        $this->subject->setHeight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'height',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRouteReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getRoute()
        );
    }

    /**
     * @test
     */
    public function setRouteForIntSetsRoute()
    {
        $this->subject->setRoute(12);

        self::assertAttributeEquals(
            12,
            'route',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProvidersReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getProviders()
        );
    }

    /**
     * @test
     */
    public function setProvidersForIntSetsProviders()
    {
        $this->subject->setProviders(12);

        self::assertAttributeEquals(
            12,
            'providers',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGnWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getGnWaybill()
        );
    }

    /**
     * @test
     */
    public function setGnWaybillForStringSetsGnWaybill()
    {
        $this->subject->setGnWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'gnWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGnTrackingReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getGnTracking()
        );
    }

    /**
     * @test
     */
    public function setGnTrackingForStringSetsGnTracking()
    {
        $this->subject->setGnTracking('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'gnTracking',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGnStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGnStatus()
        );
    }

    /**
     * @test
     */
    public function setGnStatusForIntSetsGnStatus()
    {
        $this->subject->setGnStatus(12);

        self::assertAttributeEquals(
            12,
            'gnStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGjWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getGjWaybill()
        );
    }

    /**
     * @test
     */
    public function setGjWaybillForStringSetsGjWaybill()
    {
        $this->subject->setGjWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'gjWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGjTrackingReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getGjTracking()
        );
    }

    /**
     * @test
     */
    public function setGjTrackingForStringSetsGjTracking()
    {
        $this->subject->setGjTracking('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'gjTracking',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGjStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGjStatus()
        );
    }

    /**
     * @test
     */
    public function setGjStatusForIntSetsGjStatus()
    {
        $this->subject->setGjStatus(12);

        self::assertAttributeEquals(
            12,
            'gjStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDeliveryTypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getDeliveryType()
        );
    }

    /**
     * @test
     */
    public function setDeliveryTypeForIntSetsDeliveryType()
    {
        $this->subject->setDeliveryType(12);

        self::assertAttributeEquals(
            12,
            'deliveryType',
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
    public function getCustomermailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCustomermail()
        );
    }

    /**
     * @test
     */
    public function setCustomermailForStringSetsCustomermail()
    {
        $this->subject->setCustomermail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'customermail',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLogsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLogs()
        );
    }

    /**
     * @test
     */
    public function setLogsForStringSetsLogs()
    {
        $this->subject->setLogs('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'logs',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReissueReturnsInitialValueForShipper()
    {
        self::assertEquals(
            null,
            $this->subject->getReissue()
        );
    }

    /**
     * @test
     */
    public function setReissueForShipperSetsReissue()
    {
        $reissueFixture = new \ERP\ErpManagementOrder\Domain\Model\Shipper();
        $this->subject->setReissue($reissueFixture);

        self::assertAttributeEquals(
            $reissueFixture,
            'reissue',
            $this->subject
        );
    }
}
