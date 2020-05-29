<?php
namespace ERP\ErpManagementUser\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ErpUserTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementUser\Domain\Model\ErpUser();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getAuthcodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthcode()
        );
    }

    /**
     * @test
     */
    public function setAuthcodeForStringSetsAuthcode()
    {
        $this->subject->setAuthcode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authcode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWxopenidReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWxopenid()
        );
    }

    /**
     * @test
     */
    public function setWxopenidForStringSetsWxopenid()
    {
        $this->subject->setWxopenid('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'wxopenid',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBindipReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBindip()
        );
    }

    /**
     * @test
     */
    public function setBindipForStringSetsBindip()
    {
        $this->subject->setBindip('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'bindip',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNicknameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNickname()
        );
    }

    /**
     * @test
     */
    public function setNicknameForStringSetsNickname()
    {
        $this->subject->setNickname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nickname',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setCityForRegionSetsCity()
    {
    }

    /**
     * @test
     */
    public function getProvinceReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setProvinceForRegionSetsProvince()
    {
    }
}
