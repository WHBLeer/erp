<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class SenderControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Controller\SenderController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementLogistics\Controller\SenderController::class)
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
    public function listActionFetchesAllSendersFromRepositoryAndAssignsThemToView()
    {

        $allSenders = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $senderRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\SenderRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $senderRepository->expects(self::once())->method('findAll')->will(self::returnValue($allSenders));
        $this->inject($this->subject, 'senderRepository', $senderRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('senders', $allSenders);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenSenderToView()
    {
        $sender = new \ERP\ErpManagementLogistics\Domain\Model\Sender();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('sender', $sender);

        $this->subject->showAction($sender);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenSenderToSenderRepository()
    {
        $sender = new \ERP\ErpManagementLogistics\Domain\Model\Sender();

        $senderRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\SenderRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $senderRepository->expects(self::once())->method('add')->with($sender);
        $this->inject($this->subject, 'senderRepository', $senderRepository);

        $this->subject->createAction($sender);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenSenderToView()
    {
        $sender = new \ERP\ErpManagementLogistics\Domain\Model\Sender();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('sender', $sender);

        $this->subject->editAction($sender);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenSenderInSenderRepository()
    {
        $sender = new \ERP\ErpManagementLogistics\Domain\Model\Sender();

        $senderRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\SenderRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $senderRepository->expects(self::once())->method('update')->with($sender);
        $this->inject($this->subject, 'senderRepository', $senderRepository);

        $this->subject->updateAction($sender);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenSenderFromSenderRepository()
    {
        $sender = new \ERP\ErpManagementLogistics\Domain\Model\Sender();

        $senderRepository = $this->getMockBuilder(\ERP\ErpManagementLogistics\Domain\Repository\SenderRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $senderRepository->expects(self::once())->method('remove')->with($sender);
        $this->inject($this->subject, 'senderRepository', $senderRepository);

        $this->subject->deleteAction($sender);
    }
}
