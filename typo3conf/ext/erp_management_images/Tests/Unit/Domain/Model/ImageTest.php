<?php
namespace ERP\ErpManagementImages\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ImageTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementImages\Domain\Model\Image
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementImages\Domain\Model\Image();
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
    public function getReNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getReName()
        );
    }

    /**
     * @test
     */
    public function setReNameForStringSetsReName()
    {
        $this->subject->setReName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'reName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOriginalReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOriginal()
        );
    }

    /**
     * @test
     */
    public function setOriginalForStringSetsOriginal()
    {
        $this->subject->setOriginal('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'original',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getThumbnailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getThumbnail()
        );
    }

    /**
     * @test
     */
    public function setThumbnailForStringSetsThumbnail()
    {
        $this->subject->setThumbnail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'thumbnail',
            $this->subject
        );
    }
}
