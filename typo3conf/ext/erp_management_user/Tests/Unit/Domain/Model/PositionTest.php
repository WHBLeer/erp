<?php
namespace ERP\ErpManagementUser\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class PositionTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Domain\Model\Position
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementUser\Domain\Model\Position();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getIpReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIp()
        );
    }

    /**
     * @test
     */
    public function setIpForStringSetsIp()
    {
        $this->subject->setIp('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ip',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLocatlatReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLocatlat()
        );
    }

    /**
     * @test
     */
    public function setLocatlatForStringSetsLocatlat()
    {
        $this->subject->setLocatlat('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'locatlat',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLocatLngReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLocatLng()
        );
    }

    /**
     * @test
     */
    public function setLocatLngForStringSetsLocatLng()
    {
        $this->subject->setLocatLng('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'locatLng',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNationReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNation()
        );
    }

    /**
     * @test
     */
    public function setNationForStringSetsNation()
    {
        $this->subject->setNation('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nation',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProvinceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getProvince()
        );
    }

    /**
     * @test
     */
    public function setProvinceForStringSetsProvince()
    {
        $this->subject->setProvince('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'province',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCity()
        );
    }

    /**
     * @test
     */
    public function setCityForStringSetsCity()
    {
        $this->subject->setCity('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'city',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDistrictReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDistrict()
        );
    }

    /**
     * @test
     */
    public function setDistrictForStringSetsDistrict()
    {
        $this->subject->setDistrict('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'district',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAdcodeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getAdcode()
        );
    }

    /**
     * @test
     */
    public function setAdcodeForIntSetsAdcode()
    {
        $this->subject->setAdcode(12);

        self::assertAttributeEquals(
            12,
            'adcode',
            $this->subject
        );
    }
}
