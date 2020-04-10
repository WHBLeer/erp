<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class InfoTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Domain\Model\Info
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProduct\Domain\Model\Info();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTradeNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTradeName()
        );
    }

    /**
     * @test
     */
    public function setTradeNameForStringSetsTradeName()
    {
        $this->subject->setTradeName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'tradeName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBrandNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBrandName()
        );
    }

    /**
     * @test
     */
    public function setBrandNameForStringSetsBrandName()
    {
        $this->subject->setBrandName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'brandName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTradeNumReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTradeNum()
        );
    }

    /**
     * @test
     */
    public function setTradeNumForStringSetsTradeNum()
    {
        $this->subject->setTradeNum('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'tradeNum',
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
    public function getSourceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSource()
        );
    }

    /**
     * @test
     */
    public function setSourceForStringSetsSource()
    {
        $this->subject->setSource('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'source',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLinkReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLink()
        );
    }

    /**
     * @test
     */
    public function setLinkForStringSetsLink()
    {
        $this->subject->setLink('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'link',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCode()
        );
    }

    /**
     * @test
     */
    public function setCodeForStringSetsCode()
    {
        $this->subject->setCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'code',
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
}
