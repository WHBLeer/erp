<?php
namespace ERP\ErpManagementDict\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class RegionControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementDict\Controller\RegionController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementDict\Controller\RegionController::class)
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
    public function listActionFetchesAllRegionsFromRepositoryAndAssignsThemToView()
    {

        $allRegions = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $regionRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\RegionRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $regionRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRegions));
        $this->inject($this->subject, 'regionRepository', $regionRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('regions', $allRegions);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRegionToView()
    {
        $region = new \ERP\ErpManagementDict\Domain\Model\Region();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('region', $region);

        $this->subject->showAction($region);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRegionToRegionRepository()
    {
        $region = new \ERP\ErpManagementDict\Domain\Model\Region();

        $regionRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\RegionRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $regionRepository->expects(self::once())->method('add')->with($region);
        $this->inject($this->subject, 'regionRepository', $regionRepository);

        $this->subject->createAction($region);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRegionToView()
    {
        $region = new \ERP\ErpManagementDict\Domain\Model\Region();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('region', $region);

        $this->subject->editAction($region);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRegionInRegionRepository()
    {
        $region = new \ERP\ErpManagementDict\Domain\Model\Region();

        $regionRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\RegionRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $regionRepository->expects(self::once())->method('update')->with($region);
        $this->inject($this->subject, 'regionRepository', $regionRepository);

        $this->subject->updateAction($region);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRegionFromRegionRepository()
    {
        $region = new \ERP\ErpManagementDict\Domain\Model\Region();

        $regionRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\RegionRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $regionRepository->expects(self::once())->method('remove')->with($region);
        $this->inject($this->subject, 'regionRepository', $regionRepository);

        $this->subject->deleteAction($region);
    }
}
