<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class VariantsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Controller\VariantsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementProduct\Controller\VariantsController::class)
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
    public function listActionFetchesAllVariantssFromRepositoryAndAssignsThemToView()
    {

        $allVariantss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $variantsRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\VariantsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $variantsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allVariantss));
        $this->inject($this->subject, 'variantsRepository', $variantsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('variantss', $allVariantss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenVariantsToView()
    {
        $variants = new \ERP\ErpManagementProduct\Domain\Model\Variants();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('variants', $variants);

        $this->subject->showAction($variants);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenVariantsToVariantsRepository()
    {
        $variants = new \ERP\ErpManagementProduct\Domain\Model\Variants();

        $variantsRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\VariantsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $variantsRepository->expects(self::once())->method('add')->with($variants);
        $this->inject($this->subject, 'variantsRepository', $variantsRepository);

        $this->subject->createAction($variants);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenVariantsToView()
    {
        $variants = new \ERP\ErpManagementProduct\Domain\Model\Variants();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('variants', $variants);

        $this->subject->editAction($variants);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenVariantsInVariantsRepository()
    {
        $variants = new \ERP\ErpManagementProduct\Domain\Model\Variants();

        $variantsRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\VariantsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $variantsRepository->expects(self::once())->method('update')->with($variants);
        $this->inject($this->subject, 'variantsRepository', $variantsRepository);

        $this->subject->updateAction($variants);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenVariantsFromVariantsRepository()
    {
        $variants = new \ERP\ErpManagementProduct\Domain\Model\Variants();

        $variantsRepository = $this->getMockBuilder(\ERP\ErpManagementProduct\Domain\Repository\VariantsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $variantsRepository->expects(self::once())->method('remove')->with($variants);
        $this->inject($this->subject, 'variantsRepository', $variantsRepository);

        $this->subject->deleteAction($variants);
    }
}
