<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementDashboard',
            'Pi1',
            '仪表板'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_dashboard') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_dashboard/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_dashboard', 'Configuration/TypoScript', '仪表板');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementdashboard_domain_model_dashboard', 'EXT:erp_management_dashboard/Resources/Private/Language/locallang_csh_tx_erpmanagementdashboard_domain_model_dashboard.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementdashboard_domain_model_dashboard');

    }
);
