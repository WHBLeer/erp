<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RevenueControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Controller\RevenueController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementOrder\Controller\RevenueController::class)
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
    public function listActionFetchesAllRevenuesFromRepositoryAndAssignsThemToView()
    {

        $allRevenues = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $revenueRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\RevenueRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $revenueRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRevenues));
        $this->inject($this->subject, 'revenueRepository', $revenueRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('revenues', $allRevenues);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRevenueToView()
    {
        $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('revenue', $revenue);

        $this->subject->showAction($revenue);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRevenueToRevenueRepository()
    {
        $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue();

        $revenueRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\RevenueRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $revenueRepository->expects(self::once())->method('add')->with($revenue);
        $this->inject($this->subject, 'revenueRepository', $revenueRepository);

        $this->subject->createAction($revenue);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRevenueToView()
    {
        $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('revenue', $revenue);

        $this->subject->editAction($revenue);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRevenueInRevenueRepository()
    {
        $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue();

        $revenueRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\RevenueRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $revenueRepository->expects(self::once())->method('update')->with($revenue);
        $this->inject($this->subject, 'revenueRepository', $revenueRepository);

        $this->subject->updateAction($revenue);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRevenueFromRevenueRepository()
    {
        $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue();

        $revenueRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\RevenueRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $revenueRepository->expects(self::once())->method('remove')->with($revenue);
        $this->inject($this->subject, 'revenueRepository', $revenueRepository);

        $this->subject->deleteAction($revenue);
    }
}
