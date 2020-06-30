<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth',
        'label' => 'developer_id',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'developer_id,shopalias,awsaccount,authcountry,amazon_id,amazon_token',
        'iconfile' => 'EXT:erp_management_user/Resources/Public/Icons/tx_erpmanagementuser_domain_model_erpuserauth.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, developer_id, shopalias, awsaccount, authcountry, authtime, amazon_id, amazon_token, authtype, market',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, developer_id, shopalias, awsaccount, authcountry, authtime, amazon_id, amazon_token, authtype, market, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_erpmanagementuser_domain_model_erpuserauth',
                'foreign_table_where' => 'AND {#tx_erpmanagementuser_domain_model_erpuserauth}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementuser_domain_model_erpuserauth}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'developer_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.developer_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shopalias' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.shopalias',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'awsaccount' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.awsaccount',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'authcountry' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.authcountry',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'authtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.authtime',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'amazon_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.amazon_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'amazon_token' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.amazon_token',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'authtype' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.authtype',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'market' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementuser_domain_model_erpuserauth.market',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementdict_domain_model_dictitem',
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
    
        'erpuser' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
