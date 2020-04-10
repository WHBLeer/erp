<?php
namespace ERP\ErpManageProductTemplate\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class TemplateTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManageProductTemplate\Domain\Model\Template
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManageProductTemplate\Domain\Model\Template();
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
    public function getNameEnReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNameEn()
        );
    }

    /**
     * @test
     */
    public function setNameEnForStringSetsNameEn()
    {
        $this->subject->setNameEn('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nameEn',
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
    public function getCloseReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getClose()
        );
    }

    /**
     * @test
     */
    public function setCloseForIntSetsClose()
    {
        $this->subject->setClose(12);

        self::assertAttributeEquals(
            12,
            'close',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getParentIdReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getParentId()
        );
    }

    /**
     * @test
     */
    public function setParentIdForIntSetsParentId()
    {
        $this->subject->setParentId(12);

        self::assertAttributeEquals(
            12,
            'parentId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBodytextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBodytext()
        );
    }

    /**
     * @test
     */
    public function setBodytextForStringSetsBodytext()
    {
        $this->subject->setBodytext('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'bodytext',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getParentReturnsInitialValueForTemplate()
    {
        self::assertEquals(
            null,
            $this->subject->getParent()
        );
    }

    /**
     * @test
     */
    public function setParentForTemplateSetsParent()
    {
        $parentFixture = new \ERP\ErpManageProductTemplate\Domain\Model\Template();
        $this->subject->setParent($parentFixture);

        self::assertAttributeEquals(
            $parentFixture,
            'parent',
            $this->subject
        );
    }
}
