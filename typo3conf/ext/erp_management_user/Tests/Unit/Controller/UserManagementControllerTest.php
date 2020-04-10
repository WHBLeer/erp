<?php
namespace ERP\ErpManagementUser\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class UserManagementControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Controller\UserManagementController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementUser\Controller\UserManagementController::class)
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
    public function listActionFetchesAllUserManagementsFromRepositoryAndAssignsThemToView()
    {

        $allUserManagements = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userManagementRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\UserManagementRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $userManagementRepository->expects(self::once())->method('findAll')->will(self::returnValue($allUserManagements));
        $this->inject($this->subject, 'userManagementRepository', $userManagementRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('userManagements', $allUserManagements);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenUserManagementToView()
    {
        $userManagement = new \ERP\ErpManagementUser\Domain\Model\UserManagement();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('userManagement', $userManagement);

        $this->subject->showAction($userManagement);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenUserManagementToUserManagementRepository()
    {
        $userManagement = new \ERP\ErpManagementUser\Domain\Model\UserManagement();

        $userManagementRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\UserManagementRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $userManagementRepository->expects(self::once())->method('add')->with($userManagement);
        $this->inject($this->subject, 'userManagementRepository', $userManagementRepository);

        $this->subject->createAction($userManagement);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenUserManagementToView()
    {
        $userManagement = new \ERP\ErpManagementUser\Domain\Model\UserManagement();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('userManagement', $userManagement);

        $this->subject->editAction($userManagement);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenUserManagementInUserManagementRepository()
    {
        $userManagement = new \ERP\ErpManagementUser\Domain\Model\UserManagement();

        $userManagementRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\UserManagementRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $userManagementRepository->expects(self::once())->method('update')->with($userManagement);
        $this->inject($this->subject, 'userManagementRepository', $userManagementRepository);

        $this->subject->updateAction($userManagement);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenUserManagementFromUserManagementRepository()
    {
        $userManagement = new \ERP\ErpManagementUser\Domain\Model\UserManagement();

        $userManagementRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\UserManagementRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $userManagementRepository->expects(self::once())->method('remove')->with($userManagement);
        $this->inject($this->subject, 'userManagementRepository', $userManagementRepository);

        $this->subject->deleteAction($userManagement);
    }
}
