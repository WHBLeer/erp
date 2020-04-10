<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class CostTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Domain\Model\Cost
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProduct\Domain\Model\Cost();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCgReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getCg()
        );
    }

    /**
     * @test
     */
    public function setCgForFloatSetsCg()
    {
        $this->subject->setCg(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'cg',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getZlReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getZl()
        );
    }

    /**
     * @test
     */
    public function setZlForFloatSetsZl()
    {
        $this->subject->setZl(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'zl',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getCcReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCc()
        );
    }

    /**
     * @test
     */
    public function setCcForStringSetsCc()
    {
        $this->subject->setCc('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'cc',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getKdReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getKd()
        );
    }

    /**
     * @test
     */
    public function setKdForIntSetsKd()
    {
        $this->subject->setKd(12);

        self::assertAttributeEquals(
            12,
            'kd',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGdReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGd()
        );
    }

    /**
     * @test
     */
    public function setGdForIntSetsGd()
    {
        $this->subject->setGd(12);

        self::assertAttributeEquals(
            12,
            'gd',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getYfReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getYf()
        );
    }

    /**
     * @test
     */
    public function setYfForFloatSetsYf()
    {
        $this->subject->setYf(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'yf',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getZkReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getZk()
        );
    }

    /**
     * @test
     */
    public function setZkForFloatSetsZk()
    {
        $this->subject->setZk(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'zk',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getCalculationReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCalculation()
        );
    }

    /**
     * @test
     */
    public function setCalculationForStringSetsCalculation()
    {
        $this->subject->setCalculation('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'calculation',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSyReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSy()
        );
    }

    /**
     * @test
     */
    public function setSyForIntSetsSy()
    {
        $this->subject->setSy(12);

        self::assertAttributeEquals(
            12,
            'sy',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSjReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSj()
        );
    }

    /**
     * @test
     */
    public function setSjForIntSetsSj()
    {
        $this->subject->setSj(12);

        self::assertAttributeEquals(
            12,
            'sj',
            $this->subject
        );
    }
}
