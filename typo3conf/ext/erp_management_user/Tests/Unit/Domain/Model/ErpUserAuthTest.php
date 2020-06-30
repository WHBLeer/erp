<?php
namespace ERP\ErpManagementUser\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ErpUserAuthTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUserAuth
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDeveloperIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDeveloperId()
        );
    }

    /**
     * @test
     */
    public function setDeveloperIdForStringSetsDeveloperId()
    {
        $this->subject->setDeveloperId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'developerId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShopaliasReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShopalias()
        );
    }

    /**
     * @test
     */
    public function setShopaliasForStringSetsShopalias()
    {
        $this->subject->setShopalias('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shopalias',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAwsaccountReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAwsaccount()
        );
    }

    /**
     * @test
     */
    public function setAwsaccountForStringSetsAwsaccount()
    {
        $this->subject->setAwsaccount('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'awsaccount',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthcountryReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthcountry()
        );
    }

    /**
     * @test
     */
    public function setAuthcountryForStringSetsAuthcountry()
    {
        $this->subject->setAuthcountry('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authcountry',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthtimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getAuthtime()
        );
    }

    /**
     * @test
     */
    public function setAuthtimeForIntSetsAuthtime()
    {
        $this->subject->setAuthtime(12);

        self::assertAttributeEquals(
            12,
            'authtime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAmazonIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAmazonId()
        );
    }

    /**
     * @test
     */
    public function setAmazonIdForStringSetsAmazonId()
    {
        $this->subject->setAmazonId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'amazonId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAmazonTokenReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAmazonToken()
        );
    }

    /**
     * @test
     */
    public function setAmazonTokenForStringSetsAmazonToken()
    {
        $this->subject->setAmazonToken('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'amazonToken',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthtypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getAuthtype()
        );
    }

    /**
     * @test
     */
    public function setAuthtypeForIntSetsAuthtype()
    {
        $this->subject->setAuthtype(12);

        self::assertAttributeEquals(
            12,
            'authtype',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMarketReturnsInitialValueForDictitem()
    {
    }

    /**
     * @test
     */
    public function setMarketForDictitemSetsMarket()
    {
    }
}
