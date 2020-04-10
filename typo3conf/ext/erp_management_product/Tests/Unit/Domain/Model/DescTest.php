<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class DescTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Domain\Model\Desc
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProduct\Domain\Model\Desc();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getKeywordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKeyword()
        );
    }

    /**
     * @test
     */
    public function setKeywordForStringSetsKeyword()
    {
        $this->subject->setKeyword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'keyword',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getKeyPointsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKeyPoints()
        );
    }

    /**
     * @test
     */
    public function setKeyPointsForStringSetsKeyPoints()
    {
        $this->subject->setKeyPoints('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'keyPoints',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLangReturnsInitialValueForDicttype()
    {
    }

    /**
     * @test
     */
    public function setLangForDicttypeSetsLang()
    {
    }
}
