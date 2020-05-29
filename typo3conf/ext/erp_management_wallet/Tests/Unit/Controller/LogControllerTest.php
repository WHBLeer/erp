<?php
namespace ERP\ErpManagementWallet\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class LogControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWallet\Controller\LogController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementWallet\Controller\LogController::class)
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
    public function listActionFetchesAllLogsFromRepositoryAndAssignsThemToView()
    {

        $allLogs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\LogRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $logRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLogs));
        $this->inject($this->subject, 'logRepository', $logRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('logs', $allLogs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLogToView()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('log', $log);

        $this->subject->showAction($log);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLogToLogRepository()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();

        $logRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\LogRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository->expects(self::once())->method('add')->with($log);
        $this->inject($this->subject, 'logRepository', $logRepository);

        $this->subject->createAction($log);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLogToView()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('log', $log);

        $this->subject->editAction($log);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLogInLogRepository()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();

        $logRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\LogRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository->expects(self::once())->method('update')->with($log);
        $this->inject($this->subject, 'logRepository', $logRepository);

        $this->subject->updateAction($log);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLogFromLogRepository()
    {
        $log = new \ERP\ErpManagementWallet\Domain\Model\Log();

        $logRepository = $this->getMockBuilder(\ERP\ErpManagementWallet\Domain\Repository\LogRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository->expects(self::once())->method('remove')->with($log);
        $this->inject($this->subject, 'logRepository', $logRepository);

        $this->subject->deleteAction($log);
    }
}
