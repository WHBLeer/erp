<?php
namespace ERP\ErpManageProductTemplate\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class TemplateControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManageProductTemplate\Controller\TemplateController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManageProductTemplate\Controller\TemplateController::class)
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
    public function listActionFetchesAllTemplatesFromRepositoryAndAssignsThemToView()
    {

        $allTemplates = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $templateRepository = $this->getMockBuilder(\ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTemplates));
        $this->inject($this->subject, 'templateRepository', $templateRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('templates', $allTemplates);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTemplateToView()
    {
        $template = new \ERP\ErpManageProductTemplate\Domain\Model\Template();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('template', $template);

        $this->subject->showAction($template);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTemplateToTemplateRepository()
    {
        $template = new \ERP\ErpManageProductTemplate\Domain\Model\Template();

        $templateRepository = $this->getMockBuilder(\ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $templateRepository->expects(self::once())->method('add')->with($template);
        $this->inject($this->subject, 'templateRepository', $templateRepository);

        $this->subject->createAction($template);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTemplateToView()
    {
        $template = new \ERP\ErpManageProductTemplate\Domain\Model\Template();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('template', $template);

        $this->subject->editAction($template);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTemplateInTemplateRepository()
    {
        $template = new \ERP\ErpManageProductTemplate\Domain\Model\Template();

        $templateRepository = $this->getMockBuilder(\ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $templateRepository->expects(self::once())->method('update')->with($template);
        $this->inject($this->subject, 'templateRepository', $templateRepository);

        $this->subject->updateAction($template);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTemplateFromTemplateRepository()
    {
        $template = new \ERP\ErpManageProductTemplate\Domain\Model\Template();

        $templateRepository = $this->getMockBuilder(\ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $templateRepository->expects(self::once())->method('remove')->with($template);
        $this->inject($this->subject, 'templateRepository', $templateRepository);

        $this->subject->deleteAction($template);
    }
}
