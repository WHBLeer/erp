<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ParcelsTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Domain\Model\Parcels
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getENameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEName()
        );
    }

    /**
     * @test
     */
    public function setENameForStringSetsEName()
    {
        $this->subject->setEName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'eName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCName()
        );
    }

    /**
     * @test
     */
    public function setCNameForStringSetsCName()
    {
        $this->subject->setCName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'cName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHSCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getHSCode()
        );
    }

    /**
     * @test
     */
    public function setHSCodeForStringSetsHSCode()
    {
        $this->subject->setHSCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'hSCode',
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
    public function getUnitPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getUnitPrice()
        );
    }

    /**
     * @test
     */
    public function setUnitPriceForFloatSetsUnitPrice()
    {
        $this->subject->setUnitPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'unitPrice',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getUnitWeightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getUnitWeight()
        );
    }

    /**
     * @test
     */
    public function setUnitWeightForFloatSetsUnitWeight()
    {
        $this->subject->setUnitWeight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'unitWeight',
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

    /**
     * @test
     */
    public function getProductUrlReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getProductUrl()
        );
    }

    /**
     * @test
     */
    public function setProductUrlForStringSetsProductUrl()
    {
        $this->subject->setProductUrl('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'productUrl',
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
    public function getInvoiceRemarkReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getInvoiceRemark()
        );
    }

    /**
     * @test
     */
    public function setInvoiceRemarkForStringSetsInvoiceRemark()
    {
        $this->subject->setInvoiceRemark('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'invoiceRemark',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCurrencyCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCurrencyCode()
        );
    }

    /**
     * @test
     */
    public function setCurrencyCodeForStringSetsCurrencyCode()
    {
        $this->subject->setCurrencyCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'currencyCode',
            $this->subject
        );
    }
}
