<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_erpmanagementuser_fe_users = [];
    $tempColumnstx_erpmanagementuser_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['UserManagement','Tx_ErpManagementUser_UserManagement']
            ],
            'default' => 'Tx_ErpManagementUser_UserManagement',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_erpmanagementuser_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

$tmp_erp_management_user_columns = [

    'authcode' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.authcode',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'wxopenid' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.wxopenid',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'bindip' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.bindip',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        ]
    ],
    'nickname' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.nickname',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'city' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.city',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_erpmanagementdict_domain_model_region',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'collapseAll' => 0,
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'showAllLocalizationLink' => 1
            ],
        ],
    ],
    'province' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement.province',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_erpmanagementdict_domain_model_region',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'collapseAll' => 0,
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'showAllLocalizationLink' => 1
            ],
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_erp_management_user_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_ErpManagementUser_UserManagement']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_ErpManagementUser_UserManagement']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_ErpManagementUser_UserManagement']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_ErpManagementUser_UserManagement']['showitem'] .= ',--div--;LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_usermanagement,';
$GLOBALS['TCA']['fe_users']['types']['Tx_ErpManagementUser_UserManagement']['showitem'] .= 'authcode, wxopenid, bindip, nickname, city, province';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_ErpManagementUser_UserManagement','Tx_ErpManagementUser_UserManagement'];
