<?php
namespace ERP\ErpManagementUser\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 王宏彬 <wanghongbin816@gmail.com>
 */
class ErpUserTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ERP\ErpManagementUser\Domain\Model\ErpUser();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getAccountIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAccountId()
        );
    }

    /**
     * @test
     */
    public function setAccountIdForStringSetsAccountId()
    {
        $this->subject->setAccountId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'accountId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWxopenidReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWxopenid()
        );
    }

    /**
     * @test
     */
    public function setWxopenidForStringSetsWxopenid()
    {
        $this->subject->setWxopenid('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'wxopenid',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBindipReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBindip()
        );
    }

    /**
     * @test
     */
    public function setBindipForStringSetsBindip()
    {
        $this->subject->setBindip('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'bindip',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNicknameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNickname()
        );
    }

    /**
     * @test
     */
    public function setNicknameForStringSetsNickname()
    {
        $this->subject->setNickname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nickname',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setCityForRegionSetsCity()
    {
    }

    /**
     * @test
     */
    public function getProvinceReturnsInitialValueForRegion()
    {
    }

    /**
     * @test
     */
    public function setProvinceForRegionSetsProvince()
    {
    }

    /**
     * @test
     */
    public function getAuthReturnsInitialValueForErpUserAuth()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getAuth()
        );
    }

    /**
     * @test
     */
    public function setAuthForObjectStorageContainingErpUserAuthSetsAuth()
    {
        $auth = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
        $objectStorageHoldingExactlyOneAuth = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneAuth->attach($auth);
        $this->subject->setAuth($objectStorageHoldingExactlyOneAuth);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneAuth,
            'auth',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addAuthToObjectStorageHoldingAuth()
    {
        $auth = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
        $authObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $authObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($auth));
        $this->inject($this->subject, 'auth', $authObjectStorageMock);

        $this->subject->addAuth($auth);
    }

    /**
     * @test
     */
    public function removeAuthFromObjectStorageHoldingAuth()
    {
        $auth = new \ERP\ErpManagementUser\Domain\Model\ErpUserAuth();
        $authObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $authObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($auth));
        $this->inject($this->subject, 'auth', $authObjectStorageMock);

        $this->subject->removeAuth($auth);
    }

    /**
     * @test
     */
    public function getPositionReturnsInitialValueForPosition()
    {
        self::assertEquals(
            null,
            $this->subject->getPosition()
        );
    }

    /**
     * @test
     */
    public function setPositionForPositionSetsPosition()
    {
        $positionFixture = new \ERP\ErpManagementUser\Domain\Model\Position();
        $this->subject->setPosition($positionFixture);

        self::assertAttributeEquals(
            $positionFixture,
            'position',
            $this->subject
        );
    }
}
