<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message',
        'label' => 'msg_type',
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
        'searchFields' => 'title,bodytext,receiver',
        'iconfile' => 'EXT:erp_management_notify/Resources/Public/Icons/tx_erpmanagementnotify_domain_model_message.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, msg_type, re_type, title, bodytext, sendtime, sender, receiver',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, msg_type, re_type, title, bodytext, sendtime, sender, receiver, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_erpmanagementnotify_domain_model_message',
                'foreign_table_where' => 'AND {#tx_erpmanagementnotify_domain_model_message}.{#pid}=###CURRENT_PID### AND {#tx_erpmanagementnotify_domain_model_message}.{#sys_language_uid} IN (-1,0)',
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

        'msg_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.msg_type',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        're_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.re_type',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bodytext' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.bodytext',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'sendtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.sendtime',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'sender' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.sender',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'receiver' => [
            'exclude' => true,
            'label' => 'LLL:EXT:erp_management_notify/Resources/Private/Language/locallang_db.xlf:tx_erpmanagementnotify_domain_model_message.receiver',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    
    ],
];
