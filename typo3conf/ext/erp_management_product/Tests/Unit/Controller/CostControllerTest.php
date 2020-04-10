<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class CostControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Controller\CostController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementProduct\Controller\CostController::class)
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
    public function listActionFetchesAllCostsFromRepositoryAndAssignsThemToView()
    {

        $allCosts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $costRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\CostRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $costRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCosts));
        $this->inject($this->subject, 'costRepository', $costRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('costs', $allCosts);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCostToView()
    {
        $cost = new \ERP\ErpManagementProduct\Domain\Model\Cost();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('cost', $cost);

        $this->subject->showAction($cost);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCostToCostRepository()
    {
        $cost = new \ERP\ErpManagementProduct\Domain\Model\Cost();

        $costRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\CostRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $costRepository->expects(self::once())->method('add')->with($cost);
        $this->inject($this->subject, 'costRepository', $costRepository);

        $this->subject->createAction($cost);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCostToView()
    {
        $cost = new \ERP\ErpManagementProduct\Domain\Model\Cost();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('cost', $cost);

        $this->subject->editAction($cost);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCostInCostRepository()
    {
        $cost = new \ERP\ErpManagementProduct\Domain\Model\Cost();

        $costRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\CostRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $costRepository->expects(self::once())->method('update')->with($cost);
        $this->inject($this->subject, 'costRepository', $costRepository);

        $this->subject->updateAction($cost);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCostFromCostRepository()
    {
        $cost = new \ERP\ErpManagementProduct\Domain\Model\Cost();

        $costRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\CostRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $costRepository->expects(self::once())->method('remove')->with($cost);
        $this->inject($this->subject, 'costRepository', $costRepository);

        $this->subject->deleteAction($cost);
    }
}
