<?php
return [
    'ctrl' => [
        'label' => 'title',
        'descriptionColumn' => 'description',
        'tstamp' => 'tstamp',
        'sortby' => 'sorting',
        'prependAtCopy' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'title' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'adminOnly' => true,
        'rootLevel' => -1,
        'setToDefaultOnCopy' => 'assign_to_groups',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'typeicon_classes' => [
            'default' => 'mimetypes-x-sys_action'
        ],
        'type' => 'type',
        'searchFields' => 'title,description'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden,title,type,description,assign_to_groups'
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.title',
            'config' => [
                'type' => 'input',
                'size' => 25,
                'max' => 255,
                'eval' => 'trim,required'
            ]
        ],
        'description' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.description',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'cols' => 48
            ]
        ],
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
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
            ]
        ],
        'type' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', '0'],
                    ['LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.type.1', '1'],
                    ['LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.type.2', '2'],
                    ['LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.type.3', '3'],
                    ['LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.type.4', '4'],
                    ['LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.type.5', '5']
                ]
            ]
        ],
        'assign_to_groups' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.assign_to_groups',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'be_groups',
                'foreign_table_where' => 'ORDER BY be_groups.title',
                'MM' => 'sys_action_asgr_mm',
                'size' => 10,
                'minitems' => 0,
                'maxitems' => 200,
                'autoSizeMax' => 10
            ]
        ],
        't1_userprefix' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t1_userprefix',
            'config' => [
                'type' => 'input',
                'size' => 25,
                'max' => 10,
                'eval' => 'trim'
            ]
        ],
        't1_allowed_groups' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t1_allowed_groups',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'be_groups',
                'foreign_table_where' => 'ORDER BY be_groups.title',
                'size' => 10,
                'maxitems' => 20,
                'autoSizeMax' => 10
            ]
        ],
        't1_create_user_dir' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t1_create_user_dir',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
            ]
        ],
        't1_copy_of_user' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t1_copy_of_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'be_users',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
            ]
        ],
        't3_listPid' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t3_listPid',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
            ]
        ],
        't3_tables' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t3_tables',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'tables',
                'items' => [
                    ['', '']
                ]
            ]
        ],
        't4_recordsToEdit' => [
            'label' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.t4_recordsToEdit',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => '*',
                'prepend_tname' => true,
                'size' => 5,
                'maxitems' => 50,
                'minitems' => 1,
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '],
        '1' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,t1_userprefix,t1_copy_of_user,t1_allowed_groups,t1_create_user_dir,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '],
        '2' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '],
        '3' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,t3_listPid,t3_tables,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '],
        '4' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,t4_recordsToEdit,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '],
        '5' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                type,title,t3_listPid;LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.new_record.pid,
                t3_tables;LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action.new_record.tablename,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,assign_to_groups,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                description,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ']
    ]
];
