<?php
namespace ERP\ErpManagementWorkorder\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class WorkorderTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWorkorder\Domain\Model\Workorder
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();
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
    public function getWorktypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getWorktype()
        );
    }

    /**
     * @test
     */
    public function setWorktypeForIntSetsWorktype()
    {
        $this->subject->setWorktype(12);

        self::assertAttributeEquals(
            12,
            'worktype',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getClosetimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getClosetime()
        );
    }

    /**
     * @test
     */
    public function setClosetimeForIntSetsClosetime()
    {
        $this->subject->setClosetime(12);

        self::assertAttributeEquals(
            12,
            'closetime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getContactReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getContact()
        );
    }

    /**
     * @test
     */
    public function setContactForStringSetsContact()
    {
        $this->subject->setContact('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'contact',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTelephoneReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTelephone()
        );
    }

    /**
     * @test
     */
    public function setTelephoneForStringSetsTelephone()
    {
        $this->subject->setTelephone('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'telephone',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDialogueReturnsInitialValueForDialogue()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getDialogue()
        );
    }

    /**
     * @test
     */
    public function setDialogueForObjectStorageContainingDialogueSetsDialogue()
    {
        $dialogue = new \ERP\ErpManagementWorkorder\Domain\Model\Dialogue();
        $objectStorageHoldingExactlyOneDialogue = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneDialogue->attach($dialogue);
        $this->subject->setDialogue($objectStorageHoldingExactlyOneDialogue);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneDialogue,
            'dialogue',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addDialogueToObjectStorageHoldingDialogue()
    {
        $dialogue = new \ERP\ErpManagementWorkorder\Domain\Model\Dialogue();
        $dialogueObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $dialogueObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($dialogue));
        $this->inject($this->subject, 'dialogue', $dialogueObjectStorageMock);

        $this->subject->addDialogue($dialogue);
    }

    /**
     * @test
     */
    public function removeDialogueFromObjectStorageHoldingDialogue()
    {
        $dialogue = new \ERP\ErpManagementWorkorder\Domain\Model\Dialogue();
        $dialogueObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $dialogueObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($dialogue));
        $this->inject($this->subject, 'dialogue', $dialogueObjectStorageMock);

        $this->subject->removeDialogue($dialogue);
    }

    /**
     * @test
     */
    public function getErpuserReturnsInitialValueForErpUser()
    {
    }

    /**
     * @test
     */
    public function setErpuserForErpUserSetsErpuser()
    {
    }
}
