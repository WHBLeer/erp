<?php
namespace TYPO3\CMS\Linkvalidator;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryHelper;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Html\HtmlParser;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class provides Processing plugin implementation
 * @internal
 */
class LinkAnalyzer
{

    /**
     * Array of tables and fields to search for broken links
     *
     * @var array
     */
    protected $searchFields = [];

    /**
     * List of page uids (rootline downwards)
     *
     * @var array
     */
    protected $pids = [];

    /**
     * Array of tables and the number of external links they contain
     *
     * @var array
     */
    protected $linkCounts = [];

    /**
     * Array of tables and the number of broken external links they contain
     *
     * @var array
     */
    protected $brokenLinkCounts = [];

    /**
     * Array of tables and records containing broken links
     *
     * @var array
     */
    protected $recordsWithBrokenLinks = [];

    /**
     * Array for hooks for own checks
     *
     * @var \TYPO3\CMS\Linkvalidator\Linktype\AbstractLinktype[]
     */
    protected $hookObjectsArr = [];

    /**
     * Reference to the current element with table:uid, e.g. pages:85
     *
     * @var string
     */
    protected $recordReference = '';

    /**
     * Linked page together with a possible anchor, e.g. 85#c105
     *
     * @var string
     */
    protected $pageWithAnchor = '';

    /**
     * The currently active TSConfig. Will be passed to the init function.
     *
     * @var array
     */
    protected $tsConfig = [];

    /**
     * Fill hookObjectsArr with different link types and possible XClasses.
     */
    public function __construct()
    {
        $this->getLanguageService()->includeLLFile('EXT:linkvalidator/Resources/Private/Language/Module/locallang.xlf');
        // Hook to handle own checks
        foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['linkvalidator']['checkLinks'] ?? [] as $key => $className) {
            $this->hookObjectsArr[$key] = GeneralUtility::makeInstance($className);
        }
    }

    /**
    * Store all the needed configuration values in class variables
    *
    * @param array  $searchField List of fields in which to search for links
    * @param string $pidList     List of comma separated page uids in which to search for links
    * @param array  $tsConfig    The currently active TSconfig.
    */
    public function init(array $searchField, $pidList, $tsConfig)
    {
        $this->searchFields = $searchField;
        $this->pids = GeneralUtility::intExplode(',', $pidList, true);
        $this->tsConfig = $tsConfig;
    }

    /**
     * Find all supported broken links and store them in tx_linkvalidator_link
     *
     * @param array $checkOptions List of hook object to activate
     * @param bool $considerHidden Defines whether to look into hidden fields
     */
    public function getLinkStatistics($checkOptions = [], $considerHidden = false)
    {
        $results = [];
        if (empty($checkOptions) || empty($this->pids)) {
            return;
        }

        $checkKeys = array_keys($checkOptions);

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_linkvalidator_link');

        $queryBuilder->delete('tx_linkvalidator_link')
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->in(
                            'record_uid',
                            $queryBuilder->createNamedParameter($this->pids, Connection::PARAM_INT_ARRAY)
                        ),
                        $queryBuilder->expr()->eq('table_name', $queryBuilder->createNamedParameter('pages'))
                    ),
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->in(
                            'record_pid',
                            $queryBuilder->createNamedParameter($this->pids, Connection::PARAM_INT_ARRAY)
                        ),
                        $queryBuilder->expr()->neq(
                            'table_name',
                            $queryBuilder->createNamedParameter('pages')
                        )
                    )
                ),
                $queryBuilder->expr()->in(
                    'link_type',
                    $queryBuilder->createNamedParameter($checkKeys, Connection::PARAM_STR_ARRAY)
                )
            )
            ->execute();

        // Traverse all configured tables
        foreach ($this->searchFields as $table => $fields) {
            // If table is not configured, assume the extension is not installed
            // and therefore no need to check it
            if (!is_array($GLOBALS['TCA'][$table])) {
                continue;
            }
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getQueryBuilderForTable($table);

            if ($considerHidden) {
                $queryBuilder->getRestrictions()
                    ->removeAll()
                    ->add(GeneralUtility::makeInstance(DeletedRestriction::class));
            }

            // Re-init selectFields for table
            $selectFields = array_merge(['uid', 'pid', $GLOBALS['TCA'][$table]['ctrl']['label']], $fields);

            $result = $queryBuilder->select(...$selectFields)
                ->from($table)
                ->where(
                    $queryBuilder->expr()->in(
                        ($table === 'pages' ? 'uid' : 'pid'),
                        $queryBuilder->createNamedParameter($this->pids, Connection::PARAM_INT_ARRAY)
                    )
                )
                ->execute();

            // @todo #64091: only select rows that have content in at least one of the relevant fields (via OR)
            while ($row = $result->fetch()) {
                $this->analyzeRecord($results, $table, $fields, $row);
            }
        }

        foreach ($this->hookObjectsArr as $key => $hookObj) {
            if (!is_array($results[$key]) || (!empty($checkOptions) && !$checkOptions[$key])) {
                continue;
            }

            //  Check them
            foreach ($results[$key] as $entryKey => $entryValue) {
                $table = $entryValue['table'];
                $record = [];
                $record['headline'] = BackendUtility::getRecordTitle($table, $entryValue['row']);
                $record['record_pid'] = $entryValue['row']['pid'];
                $record['record_uid'] = $entryValue['uid'];
                $record['table_name'] = $table;
                $record['link_title'] = $entryValue['link_title'];
                $record['field'] = $entryValue['field'];
                $record['last_check'] = time();
                $this->recordReference = $entryValue['substr']['recordRef'];
                $this->pageWithAnchor = $entryValue['pageAndAnchor'];
                if (!empty($this->pageWithAnchor)) {
                    // Page with anchor, e.g. 18#1580
                    $url = $this->pageWithAnchor;
                } else {
                    $url = $entryValue['substr']['tokenValue'];
                }
                $this->linkCounts[$table]++;
                $checkUrl = $hookObj->checkLink($url, $entryValue, $this);

                // Broken link found
                if (!$checkUrl) {
                    $response = [];
                    $response['valid'] = false;
                    $response['errorParams'] = $hookObj->getErrorParams();
                    $this->brokenLinkCounts[$table]++;
                    $record['link_type'] = $key;
                    $record['url'] = $url;
                    $record['url_response'] = serialize($response);
                    GeneralUtility::makeInstance(ConnectionPool::class)
                        ->getConnectionForTable('tx_linkvalidator_link')
                        ->insert('tx_linkvalidator_link', $record);
                } elseif (GeneralUtility::_GP('showalllinks')) {
                    $response = [];
                    $response['valid'] = true;
                    $this->brokenLinkCounts[$table]++;
                    $record['url'] = $url;
                    $record['link_type'] = $key;
                    $record['url_response'] = serialize($response);
                    GeneralUtility::makeInstance(ConnectionPool::class)
                        ->getConnectionForTable('tx_linkvalidator_link')
                        ->insert('tx_linkvalidator_link', $record);
                }
            }
        }
    }

    /**
     * Find all supported broken links for a specific record
     *
     * @param array $results Array of broken links
     * @param string $table Table name of the record
     * @param array $fields Array of fields to analyze
     * @param array $record Record to analyze
     */
    public function analyzeRecord(array &$results, $table, array $fields, array $record)
    {
        list($results, $record) = $this->emitBeforeAnalyzeRecordSignal($results, $record, $table, $fields);

        // Put together content of all relevant fields
        $haystack = '';
        /** @var HtmlParser $htmlParser */
        $htmlParser = GeneralUtility::makeInstance(HtmlParser::class);
        $idRecord = $record['uid'];
        // Get all references
        foreach ($fields as $field) {
            $haystack .= $record[$field] . ' --- ';
            $conf = $GLOBALS['TCA'][$table]['columns'][$field]['config'];
            $valueField = $record[$field];

            // Check if a TCA configured field has soft references defined (see TYPO3 Core API document)
            if (!$conf['softref'] || (string)$valueField === '') {
                continue;
            }

            // Explode the list of soft references/parameters
            $softRefs = BackendUtility::explodeSoftRefParserList($conf['softref']);
            if ($softRefs === false) {
                continue;
            }

            // Traverse soft references
            foreach ($softRefs as $spKey => $spParams) {
                /** @var \TYPO3\CMS\Core\Database\SoftReferenceIndex $softRefObj */
                $softRefObj = BackendUtility::softRefParserObj($spKey);

                // If there is an object returned...
                if (!is_object($softRefObj)) {
                    continue;
                }
                $softRefParams = $spParams;
                if (!is_array($softRefParams)) {
                    // set subst such that findRef will return substitutes for urls, emails etc
                    $softRefParams = ['subst' => true];
                }

                // Do processing
                $resultArray = $softRefObj->findRef($table, $field, $idRecord, $valueField, $spKey, $softRefParams);
                if (empty($resultArray['elements'])) {
                    continue;
                }

                if ($spKey === 'typolink_tag') {
                    $this->analyzeTypoLinks($resultArray, $results, $htmlParser, $record, $field, $table);
                } else {
                    $this->analyzeLinks($resultArray, $results, $record, $field, $table);
                }
            }
        }
    }

    /**
     * Returns the TSConfig that was passed to the init() method.
     *
     * This can be used by link checkers that get a reference of this
     * object passed to the checkLink() method.
     *
     * @return array
     */
    public function getTSConfig()
    {
        return $this->tsConfig;
    }

    /**
     * Find all supported broken links for a specific link list
     *
     * @param array $resultArray findRef parsed records
     * @param array $results Array of broken links
     * @param array $record UID of the current record
     * @param string $field The current field
     * @param string $table The current table
     */
    protected function analyzeLinks(array $resultArray, array &$results, array $record, $field, $table)
    {
        foreach ($resultArray['elements'] as $element) {
            $r = $element['subst'];
            $type = '';
            $idRecord = $record['uid'];
            if (empty($r)) {
                continue;
            }

            /** @var \TYPO3\CMS\Linkvalidator\Linktype\AbstractLinktype $hookObj */
            foreach ($this->hookObjectsArr as $keyArr => $hookObj) {
                $type = $hookObj->fetchType($r, $type, $keyArr);
                // Store the type that was found
                // This prevents overriding by internal validator
                if (!empty($type)) {
                    $r['type'] = $type;
                }
            }
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $r['tokenID']]['substr'] = $r;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $r['tokenID']]['row'] = $record;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $r['tokenID']]['table'] = $table;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $r['tokenID']]['field'] = $field;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $r['tokenID']]['uid'] = $idRecord;
        }
    }

    /**
     * Find all supported broken links for a specific typoLink
     *
     * @param array $resultArray findRef parsed records
     * @param array $results Array of broken links
     * @param HtmlParser $htmlParser Instance of html parser
     * @param array $record The current record
     * @param string $field The current field
     * @param string $table The current table
     */
    protected function analyzeTypoLinks(array $resultArray, array &$results, $htmlParser, array $record, $field, $table)
    {
        $currentR = [];
        $linkTags = $htmlParser->splitIntoBlock('a,link', $resultArray['content']);
        $idRecord = $record['uid'];
        $type = '';
        $title = '';
        $countLinkTags = count($linkTags);
        for ($i = 1; $i < $countLinkTags; $i += 2) {
            $referencedRecordType = '';
            foreach ($resultArray['elements'] as $element) {
                $type = '';
                $r = $element['subst'];
                if (empty($r['tokenID']) || substr_count($linkTags[$i], $r['tokenID']) === 0) {
                    continue;
                }

                // Type of referenced record
                if (strpos($r['recordRef'], 'pages') !== false) {
                    $currentR = $r;
                    // Contains number of the page
                    $referencedRecordType = $r['tokenValue'];
                    $wasPage = true;
                } elseif (strpos($r['recordRef'], 'tt_content') !== false && (isset($wasPage) && $wasPage === true)) {
                    $referencedRecordType = $referencedRecordType . '#c' . $r['tokenValue'];
                    $wasPage = false;
                } else {
                    $currentR = $r;
                }
                $title = strip_tags($linkTags[$i]);
            }
            /** @var \TYPO3\CMS\Linkvalidator\Linktype\AbstractLinktype $hookObj */
            foreach ($this->hookObjectsArr as $keyArr => $hookObj) {
                $type = $hookObj->fetchType($currentR, $type, $keyArr);
                // Store the type that was found
                // This prevents overriding by internal validator
                if (!empty($type)) {
                    $currentR['type'] = $type;
                }
            }
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['substr'] = $currentR;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['row'] = $record;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['table'] = $table;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['field'] = $field;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['uid'] = $idRecord;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['link_title'] = $title;
            $results[$type][$table . ':' . $field . ':' . $idRecord . ':' . $currentR['tokenID']]['pageAndAnchor'] = $referencedRecordType;
        }
    }

    /**
     * Fill a marker array with the number of links found in a list of pages
     *
     * @param string $curPage Comma separated list of page uids
     * @return array Marker array with the number of links found
     */
    public function getLinkCounts($curPage)
    {
        $markerArray = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_linkvalidator_link');
        $queryBuilder->getRestrictions()->removeAll();

        $result = $queryBuilder->select('link_type')
            ->addSelectLiteral($queryBuilder->expr()->count('uid', 'nbBrokenLinks'))
            ->from('tx_linkvalidator_link')
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->in(
                            'record_uid',
                            $queryBuilder->createNamedParameter($this->pids, Connection::PARAM_INT_ARRAY)
                        ),
                        $queryBuilder->expr()->eq('table_name', $queryBuilder->createNamedParameter('pages'))
                    ),
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->in(
                            'record_pid',
                            $queryBuilder->createNamedParameter($this->pids, Connection::PARAM_INT_ARRAY)
                        ),
                        $queryBuilder->expr()->neq('table_name', $queryBuilder->createNamedParameter('pages'))
                    )
                )
            )
            ->groupBy('link_type')
            ->execute();

        while ($row = $result->fetch()) {
            $markerArray[$row['link_type']] = $row['nbBrokenLinks'];
            $markerArray['brokenlinkCount'] += $row['nbBrokenLinks'];
        }
        return $markerArray;
    }

    /**
     * Calls TYPO3\CMS\Backend\FrontendBackendUserAuthentication::extGetTreeList.
     * Although this duplicates the function TYPO3\CMS\Backend\FrontendBackendUserAuthentication::extGetTreeList
     * this is necessary to create the object that is used recursively by the original function.
     *
     * Generates a list of page uids from $id. List does not include $id itself.
     * The only pages excluded from the list are deleted pages.
     *
     * @param int $id Start page id
     * @param int $depth Depth to traverse down the page tree.
     * @param int $begin is an optional integer that determines at which
     * @param string $permsClause Perms clause
     * @param bool $considerHidden Whether to consider hidden pages or not
     * @return string Returns the list with a comma in the end (if any pages selected!)
     */
    public function extGetTreeList($id, $depth, $begin = 0, $permsClause, $considerHidden = false)
    {
        $depth = (int)$depth;
        $begin = (int)$begin;
        $id = (int)$id;
        $theList = '';
        if ($depth === 0) {
            return $theList;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $result = $queryBuilder
            ->select('uid', 'title', 'hidden', 'extendToSubpages')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT)
                ),
                QueryHelper::stripLogicalOperatorPrefix($permsClause)
            )
            ->execute();

        while ($row = $result->fetch()) {
            if ($begin <= 0 && ($row['hidden'] == 0 || $considerHidden)) {
                $theList .= $row['uid'] . ',';
            }
            if ($depth > 1 && (!($row['hidden'] == 1 && $row['extendToSubpages'] == 1) || $considerHidden)) {
                $theList .= $this->extGetTreeList(
                    $row['uid'],
                    $depth - 1,
                    $begin - 1,
                    $permsClause,
                    $considerHidden
                );
            }
        }
        return $theList;
    }

    /**
     * Check if rootline contains a hidden page
     *
     * @param array $pageInfo Array with uid, title, hidden, extendToSubpages from pages table
     * @return bool TRUE if rootline contains a hidden page, FALSE if not
     */
    public function getRootLineIsHidden(array $pageInfo)
    {
        if ($pageInfo['pid'] === 0) {
            return false;
        }

        if ($pageInfo['extendToSubpages'] == 1 && $pageInfo['hidden'] == 1) {
            return true;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->getRestrictions()->removeAll();

        $row = $queryBuilder
            ->select('uid', 'title', 'hidden', 'extendToSubpages')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq(
                    'uid',
                    $queryBuilder->createNamedParameter($pageInfo['pid'], \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetch();

        if ($row !== false) {
            return $this->getRootLineIsHidden($row);
        }
        return false;
    }

    /**
     * Emits a signal before the record is analyzed
     *
     * @param array $results Array of broken links
     * @param array $record Record to analyze
     * @param string $table Table name of the record
     * @param array $fields Array of fields to analyze
     * @return array
     */
    protected function emitBeforeAnalyzeRecordSignal($results, $record, $table, $fields)
    {
        return $this->getSignalSlotDispatcher()->dispatch(
            self::class,
            'beforeAnalyzeRecord',
            [$results, $record, $table, $fields, $this]
        );
    }

    /**
     * @return \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     */
    protected function getSignalSlotDispatcher()
    {
        return $this->getObjectManager()->get(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected function getObjectManager()
    {
        return GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
