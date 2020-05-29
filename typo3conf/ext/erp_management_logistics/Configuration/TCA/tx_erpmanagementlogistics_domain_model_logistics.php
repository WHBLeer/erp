<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics',
        'label' => 'domestic_waybill',
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
        'searchFields' => 'domestic_waybill,international_waybill',
        'iconfile' => 'EXT:erp_management_logistics/Resources/Public/Icons/tx_erpmanagementlogistics_domain_model_logistics.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, domestic_waybill, international_waybill, estimate_freight, actual_freight, aging, weight, length, width, height, quantity, goodstype, country, erpuser',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, domestic_waybill, international_waybill, estimate_freight, actual_freight, aging, weight, length, width, height, quantity, goodstype, country, erpuser, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementlogistics_domain_model_logistics',
                'foreign_table_where' => 'AND {#tx_erpmanagementlogistics_domain_model_logistics}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementlogistics_domain_model_logistics}.{#sys_language_uid} IN (-1,0)',
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

        'domestic_waybill' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.domestic_waybill',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'international_waybill' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.international_waybill',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'estimate_freight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.estimate_freight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'actual_freight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.actual_freight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'aging' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.aging',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'weight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.weight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'length' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.length',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'width' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.width',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'height' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.height',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'quantity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.quantity',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'goodstype' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.goodstype',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'country' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.country',
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
        'erpuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_logistics/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementlogistics_domain_model_logistics.erpuser',
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
