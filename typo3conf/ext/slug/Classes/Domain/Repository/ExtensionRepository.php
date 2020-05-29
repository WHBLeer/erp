<?php
namespace SIMONKOEHLER\Slug\Domain\Repository;
use SIMONKOEHLER\Slug\Utility\HelperUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

class ExtensionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    /**
    * @var HelperUtility
    */
    protected $helper;

    public function tableExists($table){
        $tableExists = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable($table)
            ->getSchemaManager()
            ->tablesExist([$table]);
        if($tableExists){
            return true;
        }
        else{
            return false;
        }
    }

    public function getAdditionalRecords($table,$filterVariables,$additionalTables) {

        $tableConf = $additionalTables[$table];

        $this->helper = GeneralUtility::makeInstance(HelperUtility::class);
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $query = $queryBuilder
            ->select('*')
            ->from($table)
            ->orderBy($filterVariables['orderby'],$filterVariables['order']);

        // If a search key is given
        if($filterVariables['key']){
            $query->where(
                $queryBuilder->expr()->like($tableConf['slugField'],$queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($filterVariables['key']) . '%'))
            );
        }

        // If a PID is given via TypoScript configuration
        if($tableConf['pid']){
            $query->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($tableConf['pid'], \PDO::PARAM_INT))
            );
        }

        $statement = $query->execute();
        $output = array();
        while ($row = $statement->fetch()) {
            $row['icon'] = $tableConf['icon'];
            $row['slugField'] = $row[$tableConf['slugField']];
            $row['flag'] = $this->helper->getFlagIconByLanguageUid($row['sys_language_uid']);
            $row['isocode'] = $this->helper->getIsoCodeByLanguageUid($row['sys_language_uid']);
            array_push($output, $row);
        }
        return $output;
    }

}
