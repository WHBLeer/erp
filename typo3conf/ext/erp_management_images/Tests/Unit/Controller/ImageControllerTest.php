<?php
namespace ERP\ErpManagementImages\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ImageControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementImages\Controller\ImageController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementImages\Controller\ImageController::class)
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
    public function listActionFetchesAllImagesFromRepositoryAndAssignsThemToView()
    {

        $allImages = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $imageRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImageRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $imageRepository->expects(self::once())->method('findAll')->will(self::returnValue($allImages));
        $this->inject($this->subject, 'imageRepository', $imageRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('images', $allImages);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenImageToView()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Image();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('image', $image);

        $this->subject->showAction($image);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenImageToImageRepository()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Image();

        $imageRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImageRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $imageRepository->expects(self::once())->method('add')->with($image);
        $this->inject($this->subject, 'imageRepository', $imageRepository);

        $this->subject->createAction($image);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenImageToView()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Image();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('image', $image);

        $this->subject->editAction($image);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenImageInImageRepository()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Image();

        $imageRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImageRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $imageRepository->expects(self::once())->method('update')->with($image);
        $this->inject($this->subject, 'imageRepository', $imageRepository);

        $this->subject->updateAction($image);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenImageFromImageRepository()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Image();

        $imageRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImageRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $imageRepository->expects(self::once())->method('remove')->with($image);
        $this->inject($this->subject, 'imageRepository', $imageRepository);

        $this->subject->deleteAction($image);
    }
}
