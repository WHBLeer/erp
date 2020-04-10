<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class VariantsTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Domain\Model\Variants
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProduct\Domain\Model\Variants();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCombinationReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCombination()
        );
    }

    /**
     * @test
     */
    public function setCombinationForStringSetsCombination()
    {
        $this->subject->setCombination('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'combination',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSkuNewReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSkuNew()
        );
    }

    /**
     * @test
     */
    public function setSkuNewForStringSetsSkuNew()
    {
        $this->subject->setSkuNew('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'skuNew',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMarkupReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getMarkup()
        );
    }

    /**
     * @test
     */
    public function setMarkupForFloatSetsMarkup()
    {
        $this->subject->setMarkup(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'markup',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getKucunReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getKucun()
        );
    }

    /**
     * @test
     */
    public function setKucunForIntSetsKucun()
    {
        $this->subject->setKucun(12);

        self::assertAttributeEquals(
            12,
            'kucun',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUpcEanReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUpcEan()
        );
    }

    /**
     * @test
     */
    public function setUpcEanForStringSetsUpcEan()
    {
        $this->subject->setUpcEan('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'upcEan',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForStringSetsImages()
    {
        $this->subject->setImages('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'images',
            $this->subject
        );
    }
}
