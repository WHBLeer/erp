<?php
namespace ERP\ErpManagementNotify\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class MessageControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementNotify\Controller\MessageController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementNotify\Controller\MessageController::class)
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
    public function listActionFetchesAllMessagesFromRepositoryAndAssignsThemToView()
    {

        $allMessages = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $messageRepository = $this->getMockBuilder(\ERP\ErpManagementNotify\Domain\Repository\MessageRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $messageRepository->expects(self::once())->method('findAll')->will(self::returnValue($allMessages));
        $this->inject($this->subject, 'messageRepository', $messageRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('messages', $allMessages);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenMessageToView()
    {
        $message = new \ERP\ErpManagementNotify\Domain\Model\Message();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('message', $message);

        $this->subject->showAction($message);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenMessageToMessageRepository()
    {
        $message = new \ERP\ErpManagementNotify\Domain\Model\Message();

        $messageRepository = $this->getMockBuilder(\ERP\ErpManagementNotify\Domain\Repository\MessageRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $messageRepository->expects(self::once())->method('add')->with($message);
        $this->inject($this->subject, 'messageRepository', $messageRepository);

        $this->subject->createAction($message);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenMessageToView()
    {
        $message = new \ERP\ErpManagementNotify\Domain\Model\Message();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('message', $message);

        $this->subject->editAction($message);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenMessageInMessageRepository()
    {
        $message = new \ERP\ErpManagementNotify\Domain\Model\Message();

        $messageRepository = $this->getMockBuilder(\ERP\ErpManagementNotify\Domain\Repository\MessageRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $messageRepository->expects(self::once())->method('update')->with($message);
        $this->inject($this->subject, 'messageRepository', $messageRepository);

        $this->subject->updateAction($message);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenMessageFromMessageRepository()
    {
        $message = new \ERP\ErpManagementNotify\Domain\Model\Message();

        $messageRepository = $this->getMockBuilder(\ERP\ErpManagementNotify\Domain\Repository\MessageRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $messageRepository->expects(self::once())->method('remove')->with($message);
        $this->inject($this->subject, 'messageRepository', $messageRepository);

        $this->subject->deleteAction($message);
    }
}
