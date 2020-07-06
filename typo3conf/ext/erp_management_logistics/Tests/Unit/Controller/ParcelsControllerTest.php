<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ParcelsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Controller\ParcelsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementLogistics\Controller\ParcelsController::class)
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
    public function listActionFetchesAllParcelssFromRepositoryAndAssignsThemToView()
    {

        $allParcelss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ParcelsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $parcelsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allParcelss));
        $this->inject($this->subject, 'parcelsRepository', $parcelsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('parcelss', $allParcelss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenParcelsToView()
    {
        $parcels = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('parcels', $parcels);

        $this->subject->showAction($parcels);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenParcelsToParcelsRepository()
    {
        $parcels = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();

        $parcelsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ParcelsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsRepository->expects(self::once())->method('add')->with($parcels);
        $this->inject($this->subject, 'parcelsRepository', $parcelsRepository);

        $this->subject->createAction($parcels);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenParcelsToView()
    {
        $parcels = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('parcels', $parcels);

        $this->subject->editAction($parcels);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenParcelsInParcelsRepository()
    {
        $parcels = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();

        $parcelsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ParcelsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsRepository->expects(self::once())->method('update')->with($parcels);
        $this->inject($this->subject, 'parcelsRepository', $parcelsRepository);

        $this->subject->updateAction($parcels);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenParcelsFromParcelsRepository()
    {
        $parcels = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();

        $parcelsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ParcelsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsRepository->expects(self::once())->method('remove')->with($parcels);
        $this->inject($this->subject, 'parcelsRepository', $parcelsRepository);

        $this->subject->deleteAction($parcels);
    }
}
