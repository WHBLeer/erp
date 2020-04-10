<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class DescControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Controller\DescController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementProduct\Controller\DescController::class)
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
    public function listActionFetchesAllDescsFromRepositoryAndAssignsThemToView()
    {

        $allDescs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $descRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $descRepository->expects(self::once())->method('findAll')->will(self::returnValue($allDescs));
        $this->inject($this->subject, 'descRepository', $descRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('descs', $allDescs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenDescToView()
    {
        $desc = new \ERP\ErpManagementProduct\Domain\Model\Desc();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('desc', $desc);

        $this->subject->showAction($desc);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenDescToDescRepository()
    {
        $desc = new \ERP\ErpManagementProduct\Domain\Model\Desc();

        $descRepository = $this->getMockBuilder(\::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $descRepository->expects(self::once())->method('add')->with($desc);
        $this->inject($this->subject, 'descRepository', $descRepository);

        $this->subject->createAction($desc);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenDescToView()
    {
        $desc = new \ERP\ErpManagementProduct\Domain\Model\Desc();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('desc', $desc);

        $this->subject->editAction($desc);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenDescInDescRepository()
    {
        $desc = new \ERP\ErpManagementProduct\Domain\Model\Desc();

        $descRepository = $this->getMockBuilder(\::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $descRepository->expects(self::once())->method('update')->with($desc);
        $this->inject($this->subject, 'descRepository', $descRepository);

        $this->subject->updateAction($desc);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenDescFromDescRepository()
    {
        $desc = new \ERP\ErpManagementProduct\Domain\Model\Desc();

        $descRepository = $this->getMockBuilder(\::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $descRepository->expects(self::once())->method('remove')->with($desc);
        $this->inject($this->subject, 'descRepository', $descRepository);

        $this->subject->deleteAction($desc);
    }
}
