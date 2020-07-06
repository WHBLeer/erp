<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ChildOrdersControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Controller\ChildOrdersController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementLogistics\Controller\ChildOrdersController::class)
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
    public function listActionFetchesAllChildOrderssFromRepositoryAndAssignsThemToView()
    {

        $allChildOrderss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ChildOrdersRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $childOrdersRepository->expects(self::once())->method('findAll')->will(self::returnValue($allChildOrderss));
        $this->inject($this->subject, 'childOrdersRepository', $childOrdersRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('childOrderss', $allChildOrderss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenChildOrdersToView()
    {
        $childOrders = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('childOrders', $childOrders);

        $this->subject->showAction($childOrders);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenChildOrdersToChildOrdersRepository()
    {
        $childOrders = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();

        $childOrdersRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ChildOrdersRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersRepository->expects(self::once())->method('add')->with($childOrders);
        $this->inject($this->subject, 'childOrdersRepository', $childOrdersRepository);

        $this->subject->createAction($childOrders);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenChildOrdersToView()
    {
        $childOrders = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('childOrders', $childOrders);

        $this->subject->editAction($childOrders);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenChildOrdersInChildOrdersRepository()
    {
        $childOrders = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();

        $childOrdersRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ChildOrdersRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersRepository->expects(self::once())->method('update')->with($childOrders);
        $this->inject($this->subject, 'childOrdersRepository', $childOrdersRepository);

        $this->subject->updateAction($childOrders);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenChildOrdersFromChildOrdersRepository()
    {
        $childOrders = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();

        $childOrdersRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ChildOrdersRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersRepository->expects(self::once())->method('remove')->with($childOrders);
        $this->inject($this->subject, 'childOrdersRepository', $childOrdersRepository);

        $this->subject->deleteAction($childOrders);
    }
}
