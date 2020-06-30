<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class AddressControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Controller\AddressController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ERP\ErpManagementOrder\Controller\AddressController::class)
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
    public function listActionFetchesAllAddressesFromRepositoryAndAssignsThemToView()
    {

        $allAddresses = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $addressRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\AddressRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $addressRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAddresses));
        $this->inject($this->subject, 'addressRepository', $addressRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('addresses', $allAddresses);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAddressToView()
    {
        $address = new \ERP\ErpManagementOrder\Domain\Model\Address();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('address', $address);

        $this->subject->showAction($address);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenAddressToAddressRepository()
    {
        $address = new \ERP\ErpManagementOrder\Domain\Model\Address();

        $addressRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\AddressRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $addressRepository->expects(self::once())->method('add')->with($address);
        $this->inject($this->subject, 'addressRepository', $addressRepository);

        $this->subject->createAction($address);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAddressToView()
    {
        $address = new \ERP\ErpManagementOrder\Domain\Model\Address();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('address', $address);

        $this->subject->editAction($address);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAddressInAddressRepository()
    {
        $address = new \ERP\ErpManagementOrder\Domain\Model\Address();

        $addressRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\AddressRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $addressRepository->expects(self::once())->method('update')->with($address);
        $this->inject($this->subject, 'addressRepository', $addressRepository);

        $this->subject->updateAction($address);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenAddressFromAddressRepository()
    {
        $address = new \ERP\ErpManagementOrder\Domain\Model\Address();

        $addressRepository = $this->getMockBuilder(\ERP\ErpManagementOrder\Domain\Repository\AddressRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $addressRepository->expects(self::once())->method('remove')->with($address);
        $this->inject($this->subject, 'addressRepository', $addressRepository);

        $this->subject->deleteAction($address);
    }
}
