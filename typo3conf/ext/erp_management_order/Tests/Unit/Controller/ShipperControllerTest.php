<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ShipperControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Controller\ShipperController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementOrder\Controller\ShipperController::class)
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
    public function listActionFetchesAllShippersFromRepositoryAndAssignsThemToView()
    {

        $allShippers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $shipperRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\ShipperRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $shipperRepository->expects(self::once())->method('findAll')->will(self::returnValue($allShippers));
        $this->inject($this->subject, 'shipperRepository', $shipperRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('shippers', $allShippers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenShipperToView()
    {
        $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('shipper', $shipper);

        $this->subject->showAction($shipper);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenShipperToShipperRepository()
    {
        $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper();

        $shipperRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\ShipperRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $shipperRepository->expects(self::once())->method('add')->with($shipper);
        $this->inject($this->subject, 'shipperRepository', $shipperRepository);

        $this->subject->createAction($shipper);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenShipperToView()
    {
        $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('shipper', $shipper);

        $this->subject->editAction($shipper);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenShipperInShipperRepository()
    {
        $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper();

        $shipperRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\ShipperRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $shipperRepository->expects(self::once())->method('update')->with($shipper);
        $this->inject($this->subject, 'shipperRepository', $shipperRepository);

        $this->subject->updateAction($shipper);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenShipperFromShipperRepository()
    {
        $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper();

        $shipperRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\ShipperRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $shipperRepository->expects(self::once())->method('remove')->with($shipper);
        $this->inject($this->subject, 'shipperRepository', $shipperRepository);

        $this->subject->deleteAction($shipper);
    }
}
