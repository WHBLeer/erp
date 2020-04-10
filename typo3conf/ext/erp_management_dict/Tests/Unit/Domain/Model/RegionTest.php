<?php
namespace ERP\ErpManagementDict\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RegionTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementDict\Domain\Model\Region();
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
    public function getParentReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getParent()
        );
    }

    /**
     * @test
     */
    public function setParentForIntSetsParent()
    {
        $this->subject->setParent(12);

        self::assertAttributeEquals(
            12,
            'parent',
            $this->subject
        );
    }
}
