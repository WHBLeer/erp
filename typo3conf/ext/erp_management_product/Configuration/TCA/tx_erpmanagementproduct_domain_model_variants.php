<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants',
        'label' => 'combination',
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
        'searchFields' => 'combination,sku_new,upc_ean,images',
        'iconfile' => 'EXT:erp_management_product/Resources/Public/Icons/tx_erpmanagementproduct_domain_model_variants.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, combination, sku_new, markup, kucun, upc_ean, images',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, combination, sku_new, markup, kucun, upc_ean, images, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementproduct_domain_model_variants',
                'foreign_table_where' => 'AND {#tx_erpmanagementproduct_domain_model_variants}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementproduct_domain_model_variants}.{#sys_language_uid} IN (-1,0)',
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

        'combination' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.combination',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'sku_new' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.sku_new',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'markup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.markup',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'kucun' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.kucun',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'upc_ean' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.upc_ean',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_product/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementproduct_domain_model_variants.images',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
    
        'product' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
