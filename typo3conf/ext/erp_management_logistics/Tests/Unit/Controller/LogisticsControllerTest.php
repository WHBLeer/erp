<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class LogisticsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Controller\LogisticsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementLogistics\Controller\LogisticsController::class)
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
    public function listActionFetchesAllLogisticssFromRepositoryAndAssignsThemToView()
    {

        $allLogisticss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logisticsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\LogisticsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $logisticsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLogisticss));
        $this->inject($this->subject, 'logisticsRepository', $logisticsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('logisticss', $allLogisticss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLogisticsToView()
    {
        $logistics = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('logistics', $logistics);

        $this->subject->showAction($logistics);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLogisticsToLogisticsRepository()
    {
        $logistics = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();

        $logisticsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\LogisticsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $logisticsRepository->expects(self::once())->method('add')->with($logistics);
        $this->inject($this->subject, 'logisticsRepository', $logisticsRepository);

        $this->subject->createAction($logistics);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLogisticsToView()
    {
        $logistics = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('logistics', $logistics);

        $this->subject->editAction($logistics);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLogisticsInLogisticsRepository()
    {
        $logistics = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();

        $logisticsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\LogisticsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $logisticsRepository->expects(self::once())->method('update')->with($logistics);
        $this->inject($this->subject, 'logisticsRepository', $logisticsRepository);

        $this->subject->updateAction($logistics);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLogisticsFromLogisticsRepository()
    {
        $logistics = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();

        $logisticsRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\LogisticsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $logisticsRepository->expects(self::once())->method('remove')->with($logistics);
        $this->inject($this->subject, 'logisticsRepository', $logisticsRepository);

        $this->subject->deleteAction($logistics);
    }
}
