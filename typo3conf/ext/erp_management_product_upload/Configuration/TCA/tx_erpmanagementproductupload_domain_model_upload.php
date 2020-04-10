<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload',
        'label' => 'subdate',
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
        'searchFields' => 'lang',
        'iconfile' => 'EXT:erp_management_product_upload/Resources/Public/Icons/tx_erpmanagementproductupload_domain_model_upload.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, subdate, lang, timing, st1, st2, st3, st4, st5, user, category, template, shop',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, subdate, lang, timing, st1, st2, st3, st4, st5, user, category, template, shop, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementproductupload_domain_model_upload',
                'foreign_table_where' => 'AND {#tx_erpmanagementproductupload_domain_model_upload}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementproductupload_domain_model_upload}.{#sys_language_uid} IN (-1,0)',
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

        'subdate' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.subdate',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'lang' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.lang',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'timing' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.timing',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'st1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.st1',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'st2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.st2',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'st3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.st3',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'st4' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.st4',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'st5' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.st5',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.user',
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
        'category' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.category',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementdict_domain_model_category',
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
        'template' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.template',
            'config' => [
                'type' => 'inline',
                'foreign_table' => '',
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
        'shop' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product_upload/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproductupload_domain_model_upload.shop',
            'config' => [
                'type' => 'inline',
                'foreign_table' => '',
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
