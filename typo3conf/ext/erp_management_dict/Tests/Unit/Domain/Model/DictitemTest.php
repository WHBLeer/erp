<?php
namespace ERP\ErpManagementDict\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class DictitemTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementDict\Domain\Model\Dictitem();
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
    public function getDicttypeReturnsInitialValueForDicttype()
    {
        self::assertEquals(
            null,
            $this->subject->getDicttype()
        );
    }

    /**
     * @test
     */
    public function setDicttypeForDicttypeSetsDicttype()
    {
        $dicttypeFixture = new \ERP\ErpManagementDict\Domain\Model\Dicttype();
        $this->subject->setDicttype($dicttypeFixture);

        self::assertAttributeEquals(
            $dicttypeFixture,
            'dicttype',
            $this->subject
        );
    }
}
