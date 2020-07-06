<?php
namespace ERP\ErpManagementLogistics\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class LogisticsTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementLogistics\Domain\Model\Logistics
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementLogistics\Domain\Model\Logistics();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDomesticWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDomesticWaybill()
        );
    }

    /**
     * @test
     */
    public function setDomesticWaybillForStringSetsDomesticWaybill()
    {
        $this->subject->setDomesticWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'domesticWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getInternationalWaybillReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getInternationalWaybill()
        );
    }

    /**
     * @test
     */
    public function setInternationalWaybillForStringSetsInternationalWaybill()
    {
        $this->subject->setInternationalWaybill('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'internationalWaybill',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCustomerOrderNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCustomerOrderNumber()
        );
    }

    /**
     * @test
     */
    public function setCustomerOrderNumberForStringSetsCustomerOrderNumber()
    {
        $this->subject->setCustomerOrderNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'customerOrderNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShippingMethodCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShippingMethodCode()
        );
    }

    /**
     * @test
     */
    public function setShippingMethodCodeForStringSetsShippingMethodCode()
    {
        $this->subject->setShippingMethodCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shippingMethodCode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTrackingNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTrackingNumber()
        );
    }

    /**
     * @test
     */
    public function setTrackingNumberForStringSetsTrackingNumber()
    {
        $this->subject->setTrackingNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'trackingNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTransactionNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTransactionNumber()
        );
    }

    /**
     * @test
     */
    public function setTransactionNumberForStringSetsTransactionNumber()
    {
        $this->subject->setTransactionNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'transactionNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTaxNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTaxNumber()
        );
    }

    /**
     * @test
     */
    public function setTaxNumberForStringSetsTaxNumber()
    {
        $this->subject->setTaxNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'taxNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLengthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLength()
        );
    }

    /**
     * @test
     */
    public function setLengthForIntSetsLength()
    {
        $this->subject->setLength(12);

        self::assertAttributeEquals(
            12,
            'length',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWidthReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getWidth()
        );
    }

    /**
     * @test
     */
    public function setWidthForIntSetsWidth()
    {
        $this->subject->setWidth(12);

        self::assertAttributeEquals(
            12,
            'width',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHeightReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getHeight()
        );
    }

    /**
     * @test
     */
    public function setHeightForIntSetsHeight()
    {
        $this->subject->setHeight(12);

        self::assertAttributeEquals(
            12,
            'height',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPackageCountReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPackageCount()
        );
    }

    /**
     * @test
     */
    public function setPackageCountForIntSetsPackageCount()
    {
        $this->subject->setPackageCount(12);

        self::assertAttributeEquals(
            12,
            'packageCount',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWeightReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getWeight()
        );
    }

    /**
     * @test
     */
    public function setWeightForFloatSetsWeight()
    {
        $this->subject->setWeight(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'weight',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getApplicationTypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getApplicationType()
        );
    }

    /**
     * @test
     */
    public function setApplicationTypeForIntSetsApplicationType()
    {
        $this->subject->setApplicationType(12);

        self::assertAttributeEquals(
            12,
            'applicationType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReturnOptionReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getReturnOption()
        );
    }

    /**
     * @test
     */
    public function setReturnOptionForIntSetsReturnOption()
    {
        $this->subject->setReturnOption(12);

        self::assertAttributeEquals(
            12,
            'returnOption',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTariffPrepayReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getTariffPrepay()
        );
    }

    /**
     * @test
     */
    public function setTariffPrepayForIntSetsTariffPrepay()
    {
        $this->subject->setTariffPrepay(12);

        self::assertAttributeEquals(
            12,
            'tariffPrepay',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getInsuranceOptionReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getInsuranceOption()
        );
    }

    /**
     * @test
     */
    public function setInsuranceOptionForIntSetsInsuranceOption()
    {
        $this->subject->setInsuranceOption(12);

        self::assertAttributeEquals(
            12,
            'insuranceOption',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCoverageReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getCoverage()
        );
    }

    /**
     * @test
     */
    public function setCoverageForFloatSetsCoverage()
    {
        $this->subject->setCoverage(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'coverage',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getSensitiveTypeIDReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSensitiveTypeID()
        );
    }

    /**
     * @test
     */
    public function setSensitiveTypeIDForIntSetsSensitiveTypeID()
    {
        $this->subject->setSensitiveTypeID(12);

        self::assertAttributeEquals(
            12,
            'sensitiveTypeID',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSourceCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSourceCode()
        );
    }

    /**
     * @test
     */
    public function setSourceCodeForStringSetsSourceCode()
    {
        $this->subject->setSourceCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'sourceCode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getErpuserReturnsInitialValueForErpUser()
    {
    }

    /**
     * @test
     */
    public function setErpuserForErpUserSetsErpuser()
    {
    }

    /**
     * @test
     */
    public function getReceiverReturnsInitialValueForReceiver()
    {
        self::assertEquals(
            null,
            $this->subject->getReceiver()
        );
    }

    /**
     * @test
     */
    public function setReceiverForReceiverSetsReceiver()
    {
        $receiverFixture = new \ERP\ErpManagementLogistics\Domain\Model\Receiver();
        $this->subject->setReceiver($receiverFixture);

        self::assertAttributeEquals(
            $receiverFixture,
            'receiver',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSenderReturnsInitialValueForSender()
    {
        self::assertEquals(
            null,
            $this->subject->getSender()
        );
    }

    /**
     * @test
     */
    public function setSenderForSenderSetsSender()
    {
        $senderFixture = new \ERP\ErpManagementLogistics\Domain\Model\Sender();
        $this->subject->setSender($senderFixture);

        self::assertAttributeEquals(
            $senderFixture,
            'sender',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getParcelsReturnsInitialValueForParcels()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getParcels()
        );
    }

    /**
     * @test
     */
    public function setParcelsForObjectStorageContainingParcelsSetsParcels()
    {
        $parcel = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();
        $objectStorageHoldingExactlyOneParcels = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneParcels->attach($parcel);
        $this->subject->setParcels($objectStorageHoldingExactlyOneParcels);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneParcels,
            'parcels',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addParcelToObjectStorageHoldingParcels()
    {
        $parcel = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();
        $parcelsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($parcel));
        $this->inject($this->subject, 'parcels', $parcelsObjectStorageMock);

        $this->subject->addParcel($parcel);
    }

    /**
     * @test
     */
    public function removeParcelFromObjectStorageHoldingParcels()
    {
        $parcel = new \ERP\ErpManagementLogistics\Domain\Model\Parcels();
        $parcelsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $parcelsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($parcel));
        $this->inject($this->subject, 'parcels', $parcelsObjectStorageMock);

        $this->subject->removeParcel($parcel);
    }

    /**
     * @test
     */
    public function getChildOrdersReturnsInitialValueForChildOrders()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getChildOrders()
        );
    }

    /**
     * @test
     */
    public function setChildOrdersForObjectStorageContainingChildOrdersSetsChildOrders()
    {
        $childOrder = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();
        $objectStorageHoldingExactlyOneChildOrders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneChildOrders->attach($childOrder);
        $this->subject->setChildOrders($objectStorageHoldingExactlyOneChildOrders);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneChildOrders,
            'childOrders',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addChildOrderToObjectStorageHoldingChildOrders()
    {
        $childOrder = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();
        $childOrdersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($childOrder));
        $this->inject($this->subject, 'childOrders', $childOrdersObjectStorageMock);

        $this->subject->addChildOrder($childOrder);
    }

    /**
     * @test
     */
    public function removeChildOrderFromObjectStorageHoldingChildOrders()
    {
        $childOrder = new \ERP\ErpManagementLogistics\Domain\Model\ChildOrders();
        $childOrdersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $childOrdersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($childOrder));
        $this->inject($this->subject, 'childOrders', $childOrdersObjectStorageMock);

        $this->subject->removeChildOrder($childOrder);
    }
}
