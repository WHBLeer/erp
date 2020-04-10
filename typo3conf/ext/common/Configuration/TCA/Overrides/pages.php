<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['pages']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['pages']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_common_pages = [];
    $tempColumnstx_common_pages[$GLOBALS['TCA']['pages']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['Config','Tx_Common_Config']
            ],
            'default' => 'Tx_Common_Config',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumnstx_common_pages);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    $GLOBALS['TCA']['pages']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['pages']['ctrl']['label']
);

$tmp_common_columns = [

    'parent_id' => [
        'exclude' => true,
        'label' => 'LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_domain_model_config.parent_id',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => 'page_'
        ],
    ],
    'icon' => [
        'exclude' => true,
        'label' => 'LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_domain_model_config.icon',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'svg_icon' => [
        'exclude' => true,
        'label' => 'LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_domain_model_config.svg_icon',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        ]
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages',$tmp_common_columns,1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','parent_id');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','icon');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','svg_icon');
/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['pages']['types']['1']['showitem'])) {
    $GLOBALS['TCA']['pages']['types']['Tx_Common_Config']['showitem'] = $GLOBALS['TCA']['pages']['types']['1']['showitem'];
} elseif(is_array($GLOBALS['TCA']['pages']['types'])) {
    // use first entry in types array
    $pages_type_definition = reset($GLOBALS['TCA']['pages']['types']);
    $GLOBALS['TCA']['pages']['types']['Tx_Common_Config']['showitem'] = $pages_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['pages']['types']['Tx_Common_Config']['showitem'] = '';
}
$GLOBALS['TCA']['pages']['types']['Tx_Common_Config']['showitem'] .= ',--div--;LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_domain_model_config,';
$GLOBALS['TCA']['pages']['types']['Tx_Common_Config']['showitem'] .= 'parent_id,icon, svg_icon';

$GLOBALS['TCA']['pages']['columns'][$GLOBALS['TCA']['pages']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:pages.tx_extbase_type.Tx_Common_Config','Tx_Common_Config'];
