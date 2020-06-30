<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper',
        'label' => 'name_zh',
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
        'searchFields' => 'name_zh,name_en,sku,email,gn_waybill,gn_tracking,gj_waybill,gj_tracking,remark,customermail,logs',
        'iconfile' => 'EXT:erp_management_order/Resources/Public/Icons/tx_erpmanagementorder_domain_model_shipper.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name_zh, name_en, sku, number, weight, length, width, height, email, route, providers, gn_waybill, gn_tracking, gn_status, gj_waybill, gj_tracking, gj_status, shipper_address_line1, shipper_address_line2, shipper_address_line3, shipper_city, shipper_state_or_region, shipper_country_code, shipper_phone, shipper_address_type, shipper_is_address_sharing_confidential, delivery_type, remark, customermail, logs, reissue',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name_zh, name_en, sku, number, weight, length, width, height, email, route, providers, gn_waybill, gn_tracking, gn_status, gj_waybill, gj_tracking, gj_status, shipper_address_line1, shipper_address_line2, shipper_address_line3, shipper_city, shipper_state_or_region, shipper_country_code, shipper_phone, shipper_address_type, shipper_is_address_sharing_confidential, delivery_type, remark, customermail, logs, reissue, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementorder_domain_model_shipper',
                'foreign_table_where' => 'AND {#tx_erpmanagementorder_domain_model_shipper}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementorder_domain_model_shipper}.{#sys_language_uid} IN (-1,0)',
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

        'name_zh' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.name_zh',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'name_en' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.name_en',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'sku' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.sku',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.number',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'weight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.weight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'length' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.length',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'width' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.width',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'height' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.height',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'route' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.route',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'providers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.providers',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'gn_waybill' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gn_waybill',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'gn_tracking' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gn_tracking',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'gn_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gn_status',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'gj_waybill' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gj_waybill',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'gj_tracking' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gj_tracking',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'gj_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.gj_status',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'shipper_address_line1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_address_line1',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'shipper_address_line2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_address_line2',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'shipper_address_line3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_address_line3',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'shipper_city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shipper_state_or_region' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_state_or_region',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shipper_country_code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_country_code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shipper_phone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_phone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shipper_address_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_address_type',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'shipper_is_address_sharing_confidential' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.shipper_is_address_sharing_confidential',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'delivery_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.delivery_type',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'remark' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.remark',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'customermail' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.customermail',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'logs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.logs',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'reissue' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_shipper.reissue',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_erpmanagementorder_domain_model_shipper',
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
