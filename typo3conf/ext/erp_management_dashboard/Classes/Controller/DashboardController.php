<?php
namespace ERP\ErpManagementDashboard\Controller;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Service\OpcodeCacheService;
use TYPO3\CMS\Install\Service\ClearCacheService;
use TYPO3\CMS\Install\Service\ClearTableService;
use TYPO3\CMS\Install\Service\LanguagePackService;
use TYPO3\CMS\Install\Service\Typo3tempFileService;

/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * DashboardController
 */
class DashboardController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * dashboardRepository
     * 
     * @var \ERP\ErpManagementDashboard\Domain\Repository\DashboardRepository
     * @inject
     */
    protected $dashboardRepository = null;

    /**
     * action api
     * 
     * @param ERP\ErpManagementDashboard\Domain\Model\Dashboard
     * @return void
     */
    public function apiAction()
    {
        dump($_GET);
        dump($_POST);
        if ($cmd == 'cacheClearAll') {
            GeneralUtility::makeInstance(ClearCacheService::class)->clearAll();
            GeneralUtility::makeInstance(OpcodeCacheService::class)->clearAllActive();
        }
        
        return new JsonResponse([
            'success' => true,
            'status' => $messageQueue,
        ]);
        exit;
    }

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
        $datas = [
            'operatingSystem' => Environment::isWindows() ? 'Windows' : 'Unix',
            'phpVersion' => constant('PHP_VERSION'),
            'cgiDetected'=> (GeneralUtility::isRunningOnCgiServerApi()) ? 'Yes' : 'No' ,
            'databaseConnections' => $this->getDatabaseConnectionInformation(),
        ];
        // dump($datas);exit;
        $this->view->assignMultiple($datas);
    }

    /**
     * Get details about all configured database connections
     *
     * @return array
     */
    protected function getDatabaseConnectionInformation()
    {
        $connectionInfos = [];
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        foreach ($connectionPool->getConnectionNames() as $connectionName) {
            $connection = $connectionPool->getConnectionByName($connectionName);
            $connectionParameters = $connection->getParams();
            $connectionInfo = [
                'connectionName' => $connectionName,
                'version' => $connection->getServerVersion(),
                'databaseName' => $connection->getDatabase(),
                'username' => $connection->getUsername(),
                'host' => $connection->getHost(),
                'port' => $connection->getPort(),
                'socket' => $connectionParameters['unix_socket'] ?? '',
                'numberOfTables' => count($connection->getSchemaManager()->listTableNames()),
            ];
            if (isset($GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'])
                && is_array($GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'])
            ) {
                // Count number of array keys having $connectionName as value
                $connectionInfo['numberOfMappedTables'] = count(array_intersect(
                    $GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'],
                    [$connectionName]
                ));
            }
            $connectionInfos[] = $connectionInfo;
        }
        return $connectionInfos;
    }
}
