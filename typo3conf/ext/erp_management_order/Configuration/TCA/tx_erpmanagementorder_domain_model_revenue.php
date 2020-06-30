<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue',
        'label' => 'order_amount',
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
        'searchFields' => '',
        'iconfile' => 'EXT:erp_management_order/Resources/Public/Icons/tx_erpmanagementorder_domain_model_revenue.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, order_amount, commission, arrive, cost_amount,actual_amount, freight, service_fee, profit, profit_margin,currency_code',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, order_amount, commission, arrive, cost_amount,actual_amount, freight, service_fee, profit, profit_margin,currency_code, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementorder_domain_model_revenue',
                'foreign_table_where' => 'AND {#tx_erpmanagementorder_domain_model_revenue}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementorder_domain_model_revenue}.{#sys_language_uid} IN (-1,0)',
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

        'order_amount' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.order_amount',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'commission' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.commission',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'arrive' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.arrive',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'cost_amount' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.cost_amount',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'actual_amount' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.actual_amount',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'freight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.freight',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'service_fee' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.service_fee',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'profit' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.profit',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'profit_margin' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.profit_margin',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'currency_code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_order/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementorder_domain_model_revenue.currency_code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    
    ],
];
