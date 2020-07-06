<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

$tmp_erp_management_user_columns = [

    'account_id' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.account_id',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'wxopenid' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.wxopenid',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'bindip' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.bindip',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        ]
    ],
    'nickname' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.nickname',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'citys' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.citys',
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
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.province',
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
    'auth' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.auth',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_erpmanagementuser_domain_model_erpuserauth',
            'foreign_field' => 'erpuser',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => 0,
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'showAllLocalizationLink' => 1
            ],
        ],

    ],
    'position' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuser.position',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_erpmanagementuser_domain_model_position',
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
    'crdate' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_user_manager/Resources/Private/Language/locallang_db.xlf:tx_sllusermanager_domain_model_user.crdate',
        'config' => [
            'type' => 'input',
            'size' => 20,
            'eval' => 'datetime'
        ],
    ],
    'tstamp' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_user_manager/Resources/Private/Language/locallang_db.xlf:tx_sllusermanager_domain_model_user.tstamp',
        'config' => [
            'type' => 'input',
            'size' => 20,
            'eval' => 'datetime'
        ],
    ],
    'order_lasttime' => [
        'exclude' => true,
        'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_sllusermanager_domain_model_user.order_lasttime',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_erp_management_user_columns);
