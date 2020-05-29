<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

// Configure new fields:
$fields = array(
  'tx_slug_locked' => array(
    'label' => 'LLL:EXT:slug/Resources/Private/Language/locallang_db.xlf:tx_slug_domain_model_page.slug_lock',
    'exclude' => 1,
    'config' => array(
        'type' => 'check',
        'renderType' => 'checkboxToggle',
        'items' => [
            [
                0 => '',
                1 => '',
                'labelChecked' => 'Enabled',
                'labelUnchecked' => 'Disabled',
            ]
        ],
    ),
  )
);

// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $fields);
$GLOBALS['TCA']['pages']['columns']['slug']['config']['size'] = 100;
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'title', 'tx_slug_locked', 'after:slug');
