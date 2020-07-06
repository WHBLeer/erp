<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ReceiverControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Controller\ReceiverController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementLogistics\Controller\ReceiverController::class)
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
    public function listActionFetchesAllReceiversFromRepositoryAndAssignsThemToView()
    {

        $allReceivers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $receiverRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ReceiverRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $receiverRepository->expects(self::once())->method('findAll')->will(self::returnValue($allReceivers));
        $this->inject($this->subject, 'receiverRepository', $receiverRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('receivers', $allReceivers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenReceiverToView()
    {
        $receiver = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('receiver', $receiver);

        $this->subject->showAction($receiver);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenReceiverToReceiverRepository()
    {
        $receiver = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();

        $receiverRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ReceiverRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $receiverRepository->expects(self::once())->method('add')->with($receiver);
        $this->inject($this->subject, 'receiverRepository', $receiverRepository);

        $this->subject->createAction($receiver);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenReceiverToView()
    {
        $receiver = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('receiver', $receiver);

        $this->subject->editAction($receiver);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenReceiverInReceiverRepository()
    {
        $receiver = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();

        $receiverRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ReceiverRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $receiverRepository->expects(self::once())->method('update')->with($receiver);
        $this->inject($this->subject, 'receiverRepository', $receiverRepository);

        $this->subject->updateAction($receiver);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenReceiverFromReceiverRepository()
    {
        $receiver = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();

        $receiverRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\ReceiverRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $receiverRepository->expects(self::once())->method('remove')->with($receiver);
        $this->inject($this->subject, 'receiverRepository', $receiverRepository);

        $this->subject->deleteAction($receiver);
    }
}
