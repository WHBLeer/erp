<?php
namespace ERP\ErpManagementWallet\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RecordControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWallet\Controller\RecordController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementWallet\Controller\RecordController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllRecordsFromRepositoryAndAssignsThemToView()
    {

        $allRecords = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $recordRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\RecordRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $recordRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRecords));
        $this->inject($this->subject, 'recordRepository', $recordRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('records', $allRecords);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRecordToView()
    {
        $record = new \ERP\ErpManagementWallet\Domain\Model\Record();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('record', $record);

        $this->subject->showAction($record);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRecordToRecordRepository()
    {
        $record = new \ERP\ErpManagementWallet\Domain\Model\Record();

        $recordRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\RecordRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $recordRepository->expects(self::once())->method('add')->with($record);
        $this->inject($this->subject, 'recordRepository', $recordRepository);

        $this->subject->createAction($record);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRecordToView()
    {
        $record = new \ERP\ErpManagementWallet\Domain\Model\Record();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('record', $record);

        $this->subject->editAction($record);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRecordInRecordRepository()
    {
        $record = new \ERP\ErpManagementWallet\Domain\Model\Record();

        $recordRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\RecordRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $recordRepository->expects(self::once())->method('update')->with($record);
        $this->inject($this->subject, 'recordRepository', $recordRepository);

        $this->subject->updateAction($record);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRecordFromRecordRepository()
    {
        $record = new \ERP\ErpManagementWallet\Domain\Model\Record();

        $recordRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\RecordRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $recordRepository->expects(self::once())->method('remove')->with($record);
        $this->inject($this->subject, 'recordRepository', $recordRepository);

        $this->subject->deleteAction($record);
    }
}
