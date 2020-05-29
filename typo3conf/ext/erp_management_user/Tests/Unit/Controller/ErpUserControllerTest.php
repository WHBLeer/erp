<?php
namespace ERP\ErpManagementUser\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ErpUserControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Controller\ErpUserController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementUser\Controller\ErpUserController::class)
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
    public function listActionFetchesAllErpUsersFromRepositoryAndAssignsThemToView()
    {

        $allErpUsers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $erpUserRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\ErpUserRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $erpUserRepository->expects(self::once())->method('findAll')->will(self::returnValue($allErpUsers));
        $this->inject($this->subject, 'erpUserRepository', $erpUserRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('erpUsers', $allErpUsers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenErpUserToView()
    {
        $erpUser = new \ERP\ErpManagementUser\Domain\Model\ErpUser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('erpUser', $erpUser);

        $this->subject->showAction($erpUser);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenErpUserToErpUserRepository()
    {
        $erpUser = new \ERP\ErpManagementUser\Domain\Model\ErpUser();

        $erpUserRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\ErpUserRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $erpUserRepository->expects(self::once())->method('add')->with($erpUser);
        $this->inject($this->subject, 'erpUserRepository', $erpUserRepository);

        $this->subject->createAction($erpUser);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenErpUserToView()
    {
        $erpUser = new \ERP\ErpManagementUser\Domain\Model\ErpUser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('erpUser', $erpUser);

        $this->subject->editAction($erpUser);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenErpUserInErpUserRepository()
    {
        $erpUser = new \ERP\ErpManagementUser\Domain\Model\ErpUser();

        $erpUserRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\ErpUserRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $erpUserRepository->expects(self::once())->method('update')->with($erpUser);
        $this->inject($this->subject, 'erpUserRepository', $erpUserRepository);

        $this->subject->updateAction($erpUser);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenErpUserFromErpUserRepository()
    {
        $erpUser = new \ERP\ErpManagementUser\Domain\Model\ErpUser();

        $erpUserRepository = $this->getMockBuilder(\ERP\ErpManagementUser\Domain\Repository\ErpUserRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $erpUserRepository->expects(self::once())->method('remove')->with($erpUser);
        $this->inject($this->subject, 'erpUserRepository', $erpUserRepository);

        $this->subject->deleteAction($erpUser);
    }
}
