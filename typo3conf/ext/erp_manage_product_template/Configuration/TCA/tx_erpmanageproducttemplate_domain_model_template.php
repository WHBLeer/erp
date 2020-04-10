<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template',
        'label' => 'name',
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
        'searchFields' => 'name,name_en,code,bodytext',
        'iconfile' => 'EXT:erp_manage_product_template/Resources/Public/Icons/tx_erpmanageproducttemplate_domain_model_template.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, name_en, code, close, parent_id, bodytext, parent',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, name_en, code, close, parent_id, bodytext, parent, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanageproducttemplate_domain_model_template',
                'foreign_table_where' => 'AND {#tx_erpmanageproducttemplate_domain_model_template}.{#pid}=###CURRENT_PID### AND {#tx_erpmanageproducttemplate_domain_model_template}.{#sys_language_uid} IN (-1,0)',
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

        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'name_en' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.name_en',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'close' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.close',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'parent_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.parent_id',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'bodytext' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.bodytext',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            
        ],
        'parent' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_manage_product_template/Resources/Private/Language/locallang_db.xlf:tx_erpmanageproducttemplate_domain_model_template.parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_erpmanageproducttemplate_domain_model_template',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'crdate' => [
            'exclude' => true,
            'label' => 'crdate',
            'config' => [
                    'type' => 'input',
                    'size' => 20,
                    'eval' => 'datetime'
            ],
        ],
        'tstamp' => [
            'exclude' => true,
            'label' => 'tstamp',
            'config' => [
                    'type' => 'input',
                    'size' => 20,
                    'eval' => 'datetime'
            ],
        ],
    ],
];
