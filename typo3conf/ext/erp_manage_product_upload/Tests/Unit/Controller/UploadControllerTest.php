<?php
namespace ERP\ErpManageProductUpload\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class UploadControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManageProductUpload\Controller\UploadController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManageProductUpload\Controller\UploadController::class)
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
    public function listActionFetchesAllUploadsFromRepositoryAndAssignsThemToView()
    {

        $allUploads = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $uploadRepository = $this->getMockBuilder(\ERP\ErpManageProductUpload\Domain\Repository\UploadRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $uploadRepository->expects(self::once())->method('findAll')->will(self::returnValue($allUploads));
        $this->inject($this->subject, 'uploadRepository', $uploadRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('uploads', $allUploads);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenUploadToView()
    {
        $upload = new \ERP\ErpManageProductUpload\Domain\Model\Upload();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('upload', $upload);

        $this->subject->showAction($upload);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenUploadToUploadRepository()
    {
        $upload = new \ERP\ErpManageProductUpload\Domain\Model\Upload();

        $uploadRepository = $this->getMockBuilder(\ERP\ErpManageProductUpload\Domain\Repository\UploadRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $uploadRepository->expects(self::once())->method('add')->with($upload);
        $this->inject($this->subject, 'uploadRepository', $uploadRepository);

        $this->subject->createAction($upload);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenUploadToView()
    {
        $upload = new \ERP\ErpManageProductUpload\Domain\Model\Upload();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('upload', $upload);

        $this->subject->editAction($upload);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenUploadInUploadRepository()
    {
        $upload = new \ERP\ErpManageProductUpload\Domain\Model\Upload();

        $uploadRepository = $this->getMockBuilder(\ERP\ErpManageProductUpload\Domain\Repository\UploadRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $uploadRepository->expects(self::once())->method('update')->with($upload);
        $this->inject($this->subject, 'uploadRepository', $uploadRepository);

        $this->subject->updateAction($upload);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenUploadFromUploadRepository()
    {
        $upload = new \ERP\ErpManageProductUpload\Domain\Model\Upload();

        $uploadRepository = $this->getMockBuilder(\ERP\ErpManageProductUpload\Domain\Repository\UploadRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $uploadRepository->expects(self::once())->method('remove')->with($upload);
        $this->inject($this->subject, 'uploadRepository', $uploadRepository);

        $this->subject->deleteAction($upload);
    }
}
