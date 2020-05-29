<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class OrderControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Controller\OrderController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementOrder\Controller\OrderController::class)
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
    public function listActionFetchesAllOrdersFromRepositoryAndAssignsThemToView()
    {

        $allOrders = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $orderRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\OrderRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $orderRepository->expects(self::once())->method('findAll')->will(self::returnValue($allOrders));
        $this->inject($this->subject, 'orderRepository', $orderRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('orders', $allOrders);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenOrderToView()
    {
        $order = new \ERP\ErpManagementOrder\Domain\Model\Order();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('order', $order);

        $this->subject->showAction($order);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenOrderToOrderRepository()
    {
        $order = new \ERP\ErpManagementOrder\Domain\Model\Order();

        $orderRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\OrderRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $orderRepository->expects(self::once())->method('add')->with($order);
        $this->inject($this->subject, 'orderRepository', $orderRepository);

        $this->subject->createAction($order);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenOrderToView()
    {
        $order = new \ERP\ErpManagementOrder\Domain\Model\Order();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('order', $order);

        $this->subject->editAction($order);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenOrderInOrderRepository()
    {
        $order = new \ERP\ErpManagementOrder\Domain\Model\Order();

        $orderRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\OrderRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $orderRepository->expects(self::once())->method('update')->with($order);
        $this->inject($this->subject, 'orderRepository', $orderRepository);

        $this->subject->updateAction($order);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenOrderFromOrderRepository()
    {
        $order = new \ERP\ErpManagementOrder\Domain\Model\Order();

        $orderRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\OrderRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $orderRepository->expects(self::once())->method('remove')->with($order);
        $this->inject($this->subject, 'orderRepository', $orderRepository);

        $this->subject->deleteAction($order);
    }
}
