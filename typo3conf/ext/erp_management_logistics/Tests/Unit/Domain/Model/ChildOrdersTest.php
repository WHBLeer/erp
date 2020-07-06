<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ChildOrdersTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Domain\Model\ChildOrders
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getBoxNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBoxNumber()
        );
    }

    /**
     * @test
     */
    public function setBoxNumberForStringSetsBoxNumber()
    {
        $this->subject->setBoxNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'boxNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLengthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLength()
        );
    }

    /**
     * @test
     */
    public function setLengthForIntSetsLength()
    {
        $this->subject->setLength(12);

        self::assertAttributeEquals(
            12,
            'length',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWidthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getWidth()
        );
    }

    /**
     * @test
     */
    public function setWidthForIntSetsWidth()
    {
        $this->subject->setWidth(12);

        self::assertAttributeEquals(
            12,
            'width',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHeightReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getHeight()
        );
    }

    /**
     * @test
     */
    public function setHeightForIntSetsHeight()
    {
        $this->subject->setHeight(12);

        self::assertAttributeEquals(
            12,
            'height',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBoxWeightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getBoxWeight()
        );
    }

    /**
     * @test
     */
    public function setBoxWeightForFloatSetsBoxWeight()
    {
        $this->subject->setBoxWeight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'boxWeight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getChildDetailsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getChildDetails()
        );
    }

    /**
     * @test
     */
    public function setChildDetailsForStringSetsChildDetails()
    {
        $this->subject->setChildDetails('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'childDetails',
            $this->subject
        );
    }
}
