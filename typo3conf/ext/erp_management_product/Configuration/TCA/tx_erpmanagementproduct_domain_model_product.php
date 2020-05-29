<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product',
        'label' => 'numbering',
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
        'searchFields' => 'numbering,name,business,original,imageuids',
        'iconfile' => 'EXT:erp_management_product/Resources/Public/Icons/tx_erpmanagementproduct_domain_model_product.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, numbering, name, business, original, imageuids, category, approval, shelves, gtypes, info, cost, descr, variants, images,adduser',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, numbering, name, business, original, imageuids, category, approval, shelves, gtypes, info, cost, descr, variants, images,adduser, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_product',
                'foreign_table_where' => 'AND {#tx_erpmanagementproduct_domain_model_product}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementproduct_domain_model_product}.{#sys_language_uid} IN (-1,0)',
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

        'numbering' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.numbering',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'business' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.business',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'original' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.original',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'imageuids' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.imageuids',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'category' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.category',
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
        'approval' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.approval',
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
        'shelves' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.shelves',
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
        'gtypes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.gtypes',
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
        'info' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.info',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_info',
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
        'cost' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.cost',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_cost',
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
        'descr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.descr',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_desc',
                'foreign_field' => 'product',
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
        'variants' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.variants',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_variants',
                'foreign_field' => 'product',
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
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.images',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementimages_domain_model_images',
                'foreign_field' => 'product',
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
        'adduser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_product.adduser',
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
