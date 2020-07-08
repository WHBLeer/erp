<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload',
        'label' => 'market',
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
        'searchFields' => 'market,lang,category_text,category_node,template,gx_status,tp_status,kc_status,products',
        'iconfile' => 'EXT:erp_management_prupload/Resources/Public/Icons/tx_erpmanagementprupload_domain_model_upload.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, market, lang, category_text, category_node, template, uploadtime, cp_status, gx_status, tp_status, kc_status, jg_status, last_update_date, products, user',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, market, lang, category_text, category_node, template, uploadtime, cp_status, gx_status, tp_status, kc_status, jg_status, last_update_date, products, user, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementprupload_domain_model_upload',
                'foreign_table_where' => 'AND {#tx_erpmanagementprupload_domain_model_upload}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementprupload_domain_model_upload}.{#sys_language_uid} IN (-1,0)',
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

        'market' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.market',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'lang' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.lang',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'category_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.category_text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'category_node' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.category_node',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'template' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.template',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'uploadtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.uploadtime',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'cp_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.cp_status',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'gx_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.gx_status',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'tp_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.tp_status',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'kc_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.kc_status',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'jg_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.jg_status',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'last_update_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.last_update_date',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'products' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.products',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_prupload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementprupload_domain_model_upload.user',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'fe_users',
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
    
    ],
];
