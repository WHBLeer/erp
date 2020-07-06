<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels',
        'label' => 'e_name',
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
        'searchFields' => 'e_name,c_name,h_s_code,remark,product_url,sku,invoice_remark,currency_code',
        'iconfile' => 'EXT:erp_management_logistics/Resources/Public/Icons/tx_erpmanagementlogistics_domain_model_parcels.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, e_name, c_name, h_s_code, quantity, unit_price, unit_weight, remark, product_url, sku, invoice_remark, currency_code',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, e_name, c_name, h_s_code, quantity, unit_price, unit_weight, remark, product_url, sku, invoice_remark, currency_code, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementlogistics_domain_model_parcels',
                'foreign_table_where' => 'AND {#tx_erpmanagementlogistics_domain_model_parcels}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementlogistics_domain_model_parcels}.{#sys_language_uid} IN (-1,0)',
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

        'e_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.e_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'c_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.c_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'h_s_code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.h_s_code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'quantity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.quantity',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'unit_price' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.unit_price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'unit_weight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.unit_weight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'remark' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.remark',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'product_url' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.product_url',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'sku' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.sku',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'invoice_remark' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.invoice_remark',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'currency_code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_parcels.currency_code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    
        'logistics' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
