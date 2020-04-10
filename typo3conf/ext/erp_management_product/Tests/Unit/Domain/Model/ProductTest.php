<?php
namespace ERP\ErpManagementProduct\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ProductTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementProduct\Domain\Model\Product
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementProduct\Domain\Model\Product();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNumberingReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNumbering()
        );
    }

    /**
     * @test
     */
    public function setNumberingForStringSetsNumbering()
    {
        $this->subject->setNumbering('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'numbering',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBusinessReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBusiness()
        );
    }

    /**
     * @test
     */
    public function setBusinessForStringSetsBusiness()
    {
        $this->subject->setBusiness('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'business',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOriginalReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOriginal()
        );
    }

    /**
     * @test
     */
    public function setOriginalForStringSetsOriginal()
    {
        $this->subject->setOriginal('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'original',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getImageuidsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getImageuids()
        );
    }

    /**
     * @test
     */
    public function setImageuidsForStringSetsImageuids()
    {
        $this->subject->setImageuids('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'imageuids',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCategoryReturnsInitialValueForCategory()
    {
    }

    /**
     * @test
     */
    public function setCategoryForCategorySetsCategory()
    {
    }

    /**
     * @test
     */
    public function getApprovalReturnsInitialValueForDictitem()
    {
    }

    /**
     * @test
     */
    public function setApprovalForDictitemSetsApproval()
    {
    }

    /**
     * @test
     */
    public function getShelvesReturnsInitialValueForDictitem()
    {
    }

    /**
     * @test
     */
    public function setShelvesForDictitemSetsShelves()
    {
    }

    /**
     * @test
     */
    public function getGettypeReturnsInitialValueForDicttype()
    {
    }

    /**
     * @test
     */
    public function setGettypeForDicttypeSetsGettype()
    {
    }

    /**
     * @test
     */
    public function getInfoReturnsInitialValueForInfo()
    {
        self::assertEquals(
            null,
            $this->subject->getInfo()
        );
    }

    /**
     * @test
     */
    public function setInfoForInfoSetsInfo()
    {
        $infoFixture = new \ERP\ErpManagementProduct\Domain\Model\Info();
        $this->subject->setInfo($infoFixture);

        self::assertAttributeEquals(
            $infoFixture,
            'info',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCostReturnsInitialValueForCost()
    {
        self::assertEquals(
            null,
            $this->subject->getCost()
        );
    }

    /**
     * @test
     */
    public function setCostForCostSetsCost()
    {
        $costFixture = new \ERP\ErpManagementProduct\Domain\Model\Cost();
        $this->subject->setCost($costFixture);

        self::assertAttributeEquals(
            $costFixture,
            'cost',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescrReturnsInitialValueForDesc()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getDescr()
        );
    }

    /**
     * @test
     */
    public function setDescrForObjectStorageContainingDescSetsDescr()
    {
        $descr = new \ERP\ErpManagementProduct\Domain\Model\Desc();
        $objectStorageHoldingExactlyOneDescr = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneDescr->attach($descr);
        $this->subject->setDescr($objectStorageHoldingExactlyOneDescr);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneDescr,
            'descr',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addDescrToObjectStorageHoldingDescr()
    {
        $descr = new \ERP\ErpManagementProduct\Domain\Model\Desc();
        $descrObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $descrObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($descr));
        $this->inject($this->subject, 'descr', $descrObjectStorageMock);

        $this->subject->addDescr($descr);
    }

    /**
     * @test
     */
    public function removeDescrFromObjectStorageHoldingDescr()
    {
        $descr = new \ERP\ErpManagementProduct\Domain\Model\Desc();
        $descrObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $descrObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($descr));
        $this->inject($this->subject, 'descr', $descrObjectStorageMock);

        $this->subject->removeDescr($descr);
    }

    /**
     * @test
     */
    public function getVariantsReturnsInitialValueForVariants()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function setVariantsForObjectStorageContainingVariantsSetsVariants()
    {
        $variant = new \ERP\ErpManagementProduct\Domain\Model\Variants();
        $objectStorageHoldingExactlyOneVariants = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVariants->attach($variant);
        $this->subject->setVariants($objectStorageHoldingExactlyOneVariants);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneVariants,
            'variants',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addVariantToObjectStorageHoldingVariants()
    {
        $variant = new \ERP\ErpManagementProduct\Domain\Model\Variants();
        $variantsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $variantsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($variant));
        $this->inject($this->subject, 'variants', $variantsObjectStorageMock);

        $this->subject->addVariant($variant);
    }

    /**
     * @test
     */
    public function removeVariantFromObjectStorageHoldingVariants()
    {
        $variant = new \ERP\ErpManagementProduct\Domain\Model\Variants();
        $variantsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $variantsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($variant));
        $this->inject($this->subject, 'variants', $variantsObjectStorageMock);

        $this->subject->removeVariant($variant);
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForImages()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForObjectStorageContainingImagesSetsImages()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Images();
        $objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImages->attach($image);
        $this->subject->setImages($objectStorageHoldingExactlyOneImages);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneImages,
            'images',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImages()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Images();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImages()
    {
        $image = new \ERP\ErpManagementImages\Domain\Model\Images();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->removeImage($image);
    }
}
