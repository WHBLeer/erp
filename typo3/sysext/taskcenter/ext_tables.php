<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
    'user',
    'task',
    'top',
    '',
    [
        'routeTarget' => \TYPO3\CMS\Taskcenter\Controller\TaskModuleController::class . '::mainAction',
        'access' => 'group,user',
        'name' => 'user_task',
        'icon' => 'EXT:taskcenter/Resources/Public/Icons/module-taskcenter.svg',
        'labels' => 'LLL:EXT:taskcenter/Resources/Private/Language/locallang_mod.xlf'
    ]
);
