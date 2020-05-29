<?php
namespace ERP\ErpManagementWallet\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class LogTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWallet\Domain\Model\Log
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementWallet\Domain\Model\Log();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
    public function getChmoneyReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getChmoney()
        );
    }

    /**
     * @test
     */
    public function setChmoneyForFloatSetsChmoney()
    {
        $this->subject->setChmoney(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'chmoney',
            $this->subject,
            '',
            0.000000001
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
}
