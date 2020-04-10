<?php

/**
 * Extension Manager/Repository config file for ext "erp_management_system_extension".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'ERP Management System Extension',
    'description' => 'ERP管理系统扩展',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
            'fluid_styled_content' => '9.5.0-9.5.99',
            'rte_ckeditor' => '9.5.0-9.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Sanlilin\\ErpManagementSystemExtension\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'HongBin Wang',
    'author_email' => 'wanghongbin816@gmail.com',
    'author_company' => 'SanLiLin',
    'version' => '1.0.0',
];
