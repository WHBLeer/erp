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
