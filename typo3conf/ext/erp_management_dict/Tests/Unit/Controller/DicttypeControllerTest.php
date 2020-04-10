<?php
namespace ERP\ErpManagementDict\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class DicttypeControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementDict\Controller\DicttypeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementDict\Controller\DicttypeController::class)
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
    public function listActionFetchesAllDicttypesFromRepositoryAndAssignsThemToView()
    {

        $allDicttypes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dicttypeRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\DicttypeRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $dicttypeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allDicttypes));
        $this->inject($this->subject, 'dicttypeRepository', $dicttypeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('dicttypes', $allDicttypes);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenDicttypeToView()
    {
        $dicttype = new \ERP\ErpManagementDict\Domain\Model\Dicttype();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('dicttype', $dicttype);

        $this->subject->showAction($dicttype);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenDicttypeToDicttypeRepository()
    {
        $dicttype = new \ERP\ErpManagementDict\Domain\Model\Dicttype();

        $dicttypeRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\DicttypeRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $dicttypeRepository->expects(self::once())->method('add')->with($dicttype);
        $this->inject($this->subject, 'dicttypeRepository', $dicttypeRepository);

        $this->subject->createAction($dicttype);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenDicttypeToView()
    {
        $dicttype = new \ERP\ErpManagementDict\Domain\Model\Dicttype();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('dicttype', $dicttype);

        $this->subject->editAction($dicttype);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenDicttypeInDicttypeRepository()
    {
        $dicttype = new \ERP\ErpManagementDict\Domain\Model\Dicttype();

        $dicttypeRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\DicttypeRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $dicttypeRepository->expects(self::once())->method('update')->with($dicttype);
        $this->inject($this->subject, 'dicttypeRepository', $dicttypeRepository);

        $this->subject->updateAction($dicttype);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenDicttypeFromDicttypeRepository()
    {
        $dicttype = new \ERP\ErpManagementDict\Domain\Model\Dicttype();

        $dicttypeRepository = $this->getMockBuilder(\ERP\ErpManagementDict\Domain\Repository\DicttypeRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $dicttypeRepository->expects(self::once())->method('remove')->with($dicttype);
        $this->inject($this->subject, 'dicttypeRepository', $dicttypeRepository);

        $this->subject->deleteAction($dicttype);
    }
}
