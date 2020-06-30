<?php
namespace ERP\ErpManagementPrupload\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class UploadTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementPrupload\Domain\Model\Upload
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementPrupload\Domain\Model\Upload();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getMarketReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getMarket()
        );
    }

    /**
     * @test
     */
    public function setMarketForStringSetsMarket()
    {
        $this->subject->setMarket('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'market',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLangReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLang()
        );
    }

    /**
     * @test
     */
    public function setLangForStringSetsLang()
    {
        $this->subject->setLang('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lang',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCategoryTextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCategoryText()
        );
    }

    /**
     * @test
     */
    public function setCategoryTextForStringSetsCategoryText()
    {
        $this->subject->setCategoryText('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'categoryText',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCategoryNodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCategoryNode()
        );
    }

    /**
     * @test
     */
    public function setCategoryNodeForStringSetsCategoryNode()
    {
        $this->subject->setCategoryNode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'categoryNode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTemplateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTemplate()
        );
    }

    /**
     * @test
     */
    public function setTemplateForStringSetsTemplate()
    {
        $this->subject->setTemplate('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'template',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUploadtimeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUploadtime()
        );
    }

    /**
     * @test
     */
    public function setUploadtimeForStringSetsUploadtime()
    {
        $this->subject->setUploadtime('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'uploadtime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCpStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getCpStatus()
        );
    }

    /**
     * @test
     */
    public function setCpStatusForIntSetsCpStatus()
    {
        $this->subject->setCpStatus(12);

        self::assertAttributeEquals(
            12,
            'cpStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGxStatusReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getGxStatus()
        );
    }

    /**
     * @test
     */
    public function setGxStatusForStringSetsGxStatus()
    {
        $this->subject->setGxStatus('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'gxStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTpStatusReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTpStatus()
        );
    }

    /**
     * @test
     */
    public function setTpStatusForStringSetsTpStatus()
    {
        $this->subject->setTpStatus('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'tpStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getKcStatusReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKcStatus()
        );
    }

    /**
     * @test
     */
    public function setKcStatusForStringSetsKcStatus()
    {
        $this->subject->setKcStatus('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'kcStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getJgStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getJgStatus()
        );
    }

    /**
     * @test
     */
    public function setJgStatusForIntSetsJgStatus()
    {
        $this->subject->setJgStatus(12);

        self::assertAttributeEquals(
            12,
            'jgStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProductReturnsInitialValueForProduct()
    {
    }

    /**
     * @test
     */
    public function setProductForProductSetsProduct()
    {
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setUserForRegionSetsUser()
    {
    }
}
