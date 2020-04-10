<?php
namespace ERP\ErpManagementImages\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ImagesControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementImages\Controller\ImagesController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementImages\Controller\ImagesController::class)
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
    public function listActionFetchesAllImagessFromRepositoryAndAssignsThemToView()
    {

        $allImagess = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $imagesRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImagesRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $imagesRepository->expects(self::once())->method('findAll')->will(self::returnValue($allImagess));
        $this->inject($this->subject, 'imagesRepository', $imagesRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('imagess', $allImagess);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenImagesToView()
    {
        $images = new \ERP\ErpManagementImages\Domain\Model\Images();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('images', $images);

        $this->subject->showAction($images);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenImagesToImagesRepository()
    {
        $images = new \ERP\ErpManagementImages\Domain\Model\Images();

        $imagesRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImagesRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesRepository->expects(self::once())->method('add')->with($images);
        $this->inject($this->subject, 'imagesRepository', $imagesRepository);

        $this->subject->createAction($images);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenImagesToView()
    {
        $images = new \ERP\ErpManagementImages\Domain\Model\Images();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('images', $images);

        $this->subject->editAction($images);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenImagesInImagesRepository()
    {
        $images = new \ERP\ErpManagementImages\Domain\Model\Images();

        $imagesRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImagesRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesRepository->expects(self::once())->method('update')->with($images);
        $this->inject($this->subject, 'imagesRepository', $imagesRepository);

        $this->subject->updateAction($images);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenImagesFromImagesRepository()
    {
        $images = new \ERP\ErpManagementImages\Domain\Model\Images();

        $imagesRepository = $this->getMockBuilder(\ERP\ErpManagementImages\Domain\Repository\ImagesRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesRepository->expects(self::once())->method('remove')->with($images);
        $this->inject($this->subject, 'imagesRepository', $imagesRepository);

        $this->subject->deleteAction($images);
    }
}
