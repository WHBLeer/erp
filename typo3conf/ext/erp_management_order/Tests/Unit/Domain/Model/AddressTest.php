<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class AddressTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Domain\Model\Address
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementOrder\Domain\Model\Address();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
    public function getTelephoneReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTelephone()
        );
    }

    /**
     * @test
     */
    public function setTelephoneForStringSetsTelephone()
    {
        $this->subject->setTelephone('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'telephone',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPostcodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPostcode()
        );
    }

    /**
     * @test
     */
    public function setPostcodeForStringSetsPostcode()
    {
        $this->subject->setPostcode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'postcode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getState()
        );
    }

    /**
     * @test
     */
    public function setStateForStringSetsState()
    {
        $this->subject->setState('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'state',
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
    public function getStreetNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStreetNumber()
        );
    }

    /**
     * @test
     */
    public function setStreetNumberForStringSetsStreetNumber()
    {
        $this->subject->setStreetNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'streetNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAddressReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddress()
        );
    }

    /**
     * @test
     */
    public function setAddressForStringSetsAddress()
    {
        $this->subject->setAddress('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'address',
            $this->subject
        );
    }
}
