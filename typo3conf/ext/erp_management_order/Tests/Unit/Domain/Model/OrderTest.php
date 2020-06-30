<?php
namespace ERP\ErpManagementOrder\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class OrderTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementOrder\Domain\Model\Order
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementOrder\Domain\Model\Order();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getAmazonOrderIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAmazonOrderId()
        );
    }

    /**
     * @test
     */
    public function setAmazonOrderIdForStringSetsAmazonOrderId()
    {
        $this->subject->setAmazonOrderId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'amazonOrderId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPurchaseDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPurchaseDate()
        );
    }

    /**
     * @test
     */
    public function setPurchaseDateForIntSetsPurchaseDate()
    {
        $this->subject->setPurchaseDate(12);

        self::assertAttributeEquals(
            12,
            'purchaseDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLastUpdateDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLastUpdateDate()
        );
    }

    /**
     * @test
     */
    public function setLastUpdateDateForIntSetsLastUpdateDate()
    {
        $this->subject->setLastUpdateDate(12);

        self::assertAttributeEquals(
            12,
            'lastUpdateDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOrderStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getOrderStatus()
        );
    }

    /**
     * @test
     */
    public function setOrderStatusForIntSetsOrderStatus()
    {
        $this->subject->setOrderStatus(12);

        self::assertAttributeEquals(
            12,
            'orderStatus',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFulfillmentChannelReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getFulfillmentChannel()
        );
    }

    /**
     * @test
     */
    public function setFulfillmentChannelForIntSetsFulfillmentChannel()
    {
        $this->subject->setFulfillmentChannel(12);

        self::assertAttributeEquals(
            12,
            'fulfillmentChannel',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipServiceLevelReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getShipServiceLevel()
        );
    }

    /**
     * @test
     */
    public function setShipServiceLevelForIntSetsShipServiceLevel()
    {
        $this->subject->setShipServiceLevel(12);

        self::assertAttributeEquals(
            12,
            'shipServiceLevel',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSalesChannelReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSalesChannel()
        );
    }

    /**
     * @test
     */
    public function setSalesChannelForStringSetsSalesChannel()
    {
        $this->subject->setSalesChannel('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'salesChannel',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperAddressLine1ReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperAddressLine1()
        );
    }

    /**
     * @test
     */
    public function setShipperAddressLine1ForStringSetsShipperAddressLine1()
    {
        $this->subject->setShipperAddressLine1('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperAddressLine1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperAddressLine2ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getShipperAddressLine2()
        );
    }

    /**
     * @test
     */
    public function setShipperAddressLine2ForIntSetsShipperAddressLine2()
    {
        $this->subject->setShipperAddressLine2(12);

        self::assertAttributeEquals(
            12,
            'shipperAddressLine2',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperAddressLine3ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getShipperAddressLine3()
        );
    }

    /**
     * @test
     */
    public function setShipperAddressLine3ForIntSetsShipperAddressLine3()
    {
        $this->subject->setShipperAddressLine3(12);

        self::assertAttributeEquals(
            12,
            'shipperAddressLine3',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperCityReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperCity()
        );
    }

    /**
     * @test
     */
    public function setShipperCityForStringSetsShipperCity()
    {
        $this->subject->setShipperCity('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperCity',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperStateOrRegionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperStateOrRegion()
        );
    }

    /**
     * @test
     */
    public function setShipperStateOrRegionForStringSetsShipperStateOrRegion()
    {
        $this->subject->setShipperStateOrRegion('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperStateOrRegion',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperCountryCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperCountryCode()
        );
    }

    /**
     * @test
     */
    public function setShipperCountryCodeForStringSetsShipperCountryCode()
    {
        $this->subject->setShipperCountryCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperCountryCode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperPhoneReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperPhone()
        );
    }

    /**
     * @test
     */
    public function setShipperPhoneForStringSetsShipperPhone()
    {
        $this->subject->setShipperPhone('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperPhone',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperAddressTypeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipperAddressType()
        );
    }

    /**
     * @test
     */
    public function setShipperAddressTypeForStringSetsShipperAddressType()
    {
        $this->subject->setShipperAddressType('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipperAddressType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperIsAddressSharingConfidentialReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getShipperIsAddressSharingConfidential()
        );
    }

    /**
     * @test
     */
    public function setShipperIsAddressSharingConfidentialForIntSetsShipperIsAddressSharingConfidential()
    {
        $this->subject->setShipperIsAddressSharingConfidential(12);

        self::assertAttributeEquals(
            12,
            'shipperIsAddressSharingConfidential',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCurrencyCodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCurrencyCode()
        );
    }

    /**
     * @test
     */
    public function setCurrencyCodeForStringSetsCurrencyCode()
    {
        $this->subject->setCurrencyCode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'currencyCode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAmountReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAmount()
        );
    }

    /**
     * @test
     */
    public function setAmountForStringSetsAmount()
    {
        $this->subject->setAmount('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'amount',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNumberOfItemsShippedReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getNumberOfItemsShipped()
        );
    }

    /**
     * @test
     */
    public function setNumberOfItemsShippedForIntSetsNumberOfItemsShipped()
    {
        $this->subject->setNumberOfItemsShipped(12);

        self::assertAttributeEquals(
            12,
            'numberOfItemsShipped',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNumberOfItemsUnshippedReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getNumberOfItemsUnshipped()
        );
    }

    /**
     * @test
     */
    public function setNumberOfItemsUnshippedForIntSetsNumberOfItemsUnshipped()
    {
        $this->subject->setNumberOfItemsUnshipped(12);

        self::assertAttributeEquals(
            12,
            'numberOfItemsUnshipped',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPaymentMethodReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPaymentMethod()
        );
    }

    /**
     * @test
     */
    public function setPaymentMethodForStringSetsPaymentMethod()
    {
        $this->subject->setPaymentMethod('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'paymentMethod',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPaymentMethodDetailsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPaymentMethodDetails()
        );
    }

    /**
     * @test
     */
    public function setPaymentMethodDetailsForStringSetsPaymentMethodDetails()
    {
        $this->subject->setPaymentMethodDetails('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'paymentMethodDetails',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMarketplaceIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getMarketplaceId()
        );
    }

    /**
     * @test
     */
    public function setMarketplaceIdForStringSetsMarketplaceId()
    {
        $this->subject->setMarketplaceId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'marketplaceId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipmentServiceLevelCategoryReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShipmentServiceLevelCategory()
        );
    }

    /**
     * @test
     */
    public function setShipmentServiceLevelCategoryForStringSetsShipmentServiceLevelCategory()
    {
        $this->subject->setShipmentServiceLevelCategory('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shipmentServiceLevelCategory',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShippedByAmazonTFMReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getShippedByAmazonTFM()
        );
    }

    /**
     * @test
     */
    public function setShippedByAmazonTFMForIntSetsShippedByAmazonTFM()
    {
        $this->subject->setShippedByAmazonTFM(12);

        self::assertAttributeEquals(
            12,
            'shippedByAmazonTFM',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOrderTypeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOrderType()
        );
    }

    /**
     * @test
     */
    public function setOrderTypeForStringSetsOrderType()
    {
        $this->subject->setOrderType('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'orderType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEarliestShipDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getEarliestShipDate()
        );
    }

    /**
     * @test
     */
    public function setEarliestShipDateForIntSetsEarliestShipDate()
    {
        $this->subject->setEarliestShipDate(12);

        self::assertAttributeEquals(
            12,
            'earliestShipDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLatestShipDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLatestShipDate()
        );
    }

    /**
     * @test
     */
    public function setLatestShipDateForIntSetsLatestShipDate()
    {
        $this->subject->setLatestShipDate(12);

        self::assertAttributeEquals(
            12,
            'latestShipDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEarliestDeliveryDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getEarliestDeliveryDate()
        );
    }

    /**
     * @test
     */
    public function setEarliestDeliveryDateForIntSetsEarliestDeliveryDate()
    {
        $this->subject->setEarliestDeliveryDate(12);

        self::assertAttributeEquals(
            12,
            'earliestDeliveryDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLatestDeliveryDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getLatestDeliveryDate()
        );
    }

    /**
     * @test
     */
    public function setLatestDeliveryDateForIntSetsLatestDeliveryDate()
    {
        $this->subject->setLatestDeliveryDate(12);

        self::assertAttributeEquals(
            12,
            'latestDeliveryDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBusinessOrderReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getBusinessOrder()
        );
    }

    /**
     * @test
     */
    public function setBusinessOrderForIntSetsBusinessOrder()
    {
        $this->subject->setBusinessOrder(12);

        self::assertAttributeEquals(
            12,
            'businessOrder',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPrimeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPrime()
        );
    }

    /**
     * @test
     */
    public function setPrimeForIntSetsPrime()
    {
        $this->subject->setPrime(12);

        self::assertAttributeEquals(
            12,
            'prime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGlobalExpressEnabledReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGlobalExpressEnabled()
        );
    }

    /**
     * @test
     */
    public function setGlobalExpressEnabledForIntSetsGlobalExpressEnabled()
    {
        $this->subject->setGlobalExpressEnabled(12);

        self::assertAttributeEquals(
            12,
            'globalExpressEnabled',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPremiumOrderReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPremiumOrder()
        );
    }

    /**
     * @test
     */
    public function setPremiumOrderForIntSetsPremiumOrder()
    {
        $this->subject->setPremiumOrder(12);

        self::assertAttributeEquals(
            12,
            'premiumOrder',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReplacementOrderReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getReplacementOrder()
        );
    }

    /**
     * @test
     */
    public function setReplacementOrderForIntSetsReplacementOrder()
    {
        $this->subject->setReplacementOrder(12);

        self::assertAttributeEquals(
            12,
            'replacementOrder',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSoldByABReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSoldByAB()
        );
    }

    /**
     * @test
     */
    public function setSoldByABForIntSetsSoldByAB()
    {
        $this->subject->setSoldByAB(12);

        self::assertAttributeEquals(
            12,
            'soldByAB',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGoodsReturnsInitialValueForProduct()
    {
    }

    /**
     * @test
     */
    public function setGoodsForProductSetsGoods()
    {
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
    public function getAddressReturnsInitialValueForAddress()
    {
        self::assertEquals(
            null,
            $this->subject->getAddress()
        );
    }

    /**
     * @test
     */
    public function setAddressForAddressSetsAddress()
    {
        $addressFixture = new \ERP\ErpManagementOrder\Domain\Model\Address();
        $this->subject->setAddress($addressFixture);

        self::assertAttributeEquals(
            $addressFixture,
            'address',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShipperReturnsInitialValueForShipper()
    {
        self::assertEquals(
            null,
            $this->subject->getShipper()
        );
    }

    /**
     * @test
     */
    public function setShipperForShipperSetsShipper()
    {
        $shipperFixture = new \ERP\ErpManagementOrder\Domain\Model\Shipper();
        $this->subject->setShipper($shipperFixture);

        self::assertAttributeEquals(
            $shipperFixture,
            'shipper',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRevenueReturnsInitialValueForRevenue()
    {
        self::assertEquals(
            null,
            $this->subject->getRevenue()
        );
    }

    /**
     * @test
     */
    public function setRevenueForRevenueSetsRevenue()
    {
        $revenueFixture = new \ERP\ErpManagementOrder\Domain\Model\Revenue();
        $this->subject->setRevenue($revenueFixture);

        self::assertAttributeEquals(
            $revenueFixture,
            'revenue',
            $this->subject
        );
    }
}
