<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class InfoControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Controller\InfoController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementProduct\Controller\InfoController::class)
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
    public function listActionFetchesAllInfosFromRepositoryAndAssignsThemToView()
    {

        $allInfos = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $infoRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\InfoRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $infoRepository->expects(self::once())->method('findAll')->will(self::returnValue($allInfos));
        $this->inject($this->subject, 'infoRepository', $infoRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('infos', $allInfos);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenInfoToView()
    {
        $info = new \ERP\ErpManagementProduct\Domain\Model\Info();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('info', $info);

        $this->subject->showAction($info);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenInfoToInfoRepository()
    {
        $info = new \ERP\ErpManagementProduct\Domain\Model\Info();

        $infoRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\InfoRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $infoRepository->expects(self::once())->method('add')->with($info);
        $this->inject($this->subject, 'infoRepository', $infoRepository);

        $this->subject->createAction($info);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenInfoToView()
    {
        $info = new \ERP\ErpManagementProduct\Domain\Model\Info();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('info', $info);

        $this->subject->editAction($info);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenInfoInInfoRepository()
    {
        $info = new \ERP\ErpManagementProduct\Domain\Model\Info();

        $infoRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\InfoRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $infoRepository->expects(self::once())->method('update')->with($info);
        $this->inject($this->subject, 'infoRepository', $infoRepository);

        $this->subject->updateAction($info);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenInfoFromInfoRepository()
    {
        $info = new \ERP\ErpManagementProduct\Domain\Model\Info();

        $infoRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\InfoRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $infoRepository->expects(self::once())->method('remove')->with($info);
        $this->inject($this->subject, 'infoRepository', $infoRepository);

        $this->subject->deleteAction($info);
    }
}
