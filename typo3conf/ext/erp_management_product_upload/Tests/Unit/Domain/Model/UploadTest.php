<?php
namespace ERP\ErpManagementProductUpload\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class UploadTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProductUpload\Domain\Model\Upload
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProductUpload\Domain\Model\Upload();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getSubdateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSubdate()
        );
    }

    /**
     * @test
     */
    public function setSubdateForIntSetsSubdate()
    {
        $this->subject->setSubdate(12);

        self::assertAttributeEquals(
            12,
            'subdate',
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
    public function getTimingReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getTiming()
        );
    }

    /**
     * @test
     */
    public function setTimingForIntSetsTiming()
    {
        $this->subject->setTiming(12);

        self::assertAttributeEquals(
            12,
            'timing',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSt1ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSt1()
        );
    }

    /**
     * @test
     */
    public function setSt1ForIntSetsSt1()
    {
        $this->subject->setSt1(12);

        self::assertAttributeEquals(
            12,
            'st1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSt2ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSt2()
        );
    }

    /**
     * @test
     */
    public function setSt2ForIntSetsSt2()
    {
        $this->subject->setSt2(12);

        self::assertAttributeEquals(
            12,
            'st2',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSt3ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSt3()
        );
    }

    /**
     * @test
     */
    public function setSt3ForIntSetsSt3()
    {
        $this->subject->setSt3(12);

        self::assertAttributeEquals(
            12,
            'st3',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSt4ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSt4()
        );
    }

    /**
     * @test
     */
    public function setSt4ForIntSetsSt4()
    {
        $this->subject->setSt4(12);

        self::assertAttributeEquals(
            12,
            'st4',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSt5ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSt5()
        );
    }

    /**
     * @test
     */
    public function setSt5ForIntSetsSt5()
    {
        $this->subject->setSt5(12);

        self::assertAttributeEquals(
            12,
            'st5',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForUserManagement()
    {
    }

    /**
     * @test
     */
    public function setUserForUserManagementSetsUser()
    {
    }

    /**
     * @test
     */
    public function getCategoryReturnsInitialValueForCategory()
    {
    }

    /**
     * @test
     */
    public function setCategoryForCategorySetsCategory()
    {
    }

    /**
     * @test
     */
    public function getTemplateReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setTemplateForSetsTemplate()
    {
    }

    /**
     * @test
     */
    public function getShopReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setShopForSetsShop()
    {
    }
}
