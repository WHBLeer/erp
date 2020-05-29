<?php
namespace ERP\ErpManagementWorkorder\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class WorkorderControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementWorkorder\Controller\WorkorderController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementWorkorder\Controller\WorkorderController::class)
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
    public function listActionFetchesAllWorkordersFromRepositoryAndAssignsThemToView()
    {

        $allWorkorders = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $workorderRepository = $this->getMockBuilder(\ERP\ErpManagementWorkorder\Domain\Repository\WorkorderRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $workorderRepository->expects(self::once())->method('findAll')->will(self::returnValue($allWorkorders));
        $this->inject($this->subject, 'workorderRepository', $workorderRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('workorders', $allWorkorders);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenWorkorderToView()
    {
        $workorder = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('workorder', $workorder);

        $this->subject->showAction($workorder);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenWorkorderToWorkorderRepository()
    {
        $workorder = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();

        $workorderRepository = $this->getMockBuilder(\ERP\ErpManagementWorkorder\Domain\Repository\WorkorderRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $workorderRepository->expects(self::once())->method('add')->with($workorder);
        $this->inject($this->subject, 'workorderRepository', $workorderRepository);

        $this->subject->createAction($workorder);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenWorkorderToView()
    {
        $workorder = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('workorder', $workorder);

        $this->subject->editAction($workorder);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenWorkorderInWorkorderRepository()
    {
        $workorder = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();

        $workorderRepository = $this->getMockBuilder(\ERP\ErpManagementWorkorder\Domain\Repository\WorkorderRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $workorderRepository->expects(self::once())->method('update')->with($workorder);
        $this->inject($this->subject, 'workorderRepository', $workorderRepository);

        $this->subject->updateAction($workorder);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenWorkorderFromWorkorderRepository()
    {
        $workorder = new \ERP\ErpManagementWorkorder\Domain\Model\Workorder();

        $workorderRepository = $this->getMockBuilder(\ERP\ErpManagementWorkorder\Domain\Repository\WorkorderRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $workorderRepository->expects(self::once())->method('remove')->with($workorder);
        $this->inject($this->subject, 'workorderRepository', $workorderRepository);

        $this->subject->deleteAction($workorder);
    }
}
