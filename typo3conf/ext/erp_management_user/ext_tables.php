<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementUser',
            'Pi1',
            '用户管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_user') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_user/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_user', 'Configuration/TypoScript', '用户管理');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementuser_domain_model_erpuserauth', 'EXT:erp_management_user/Resources/Private/Language/locallang_csh_tx_erpmanagementuser_domain_model_erpuserauth.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementuser_domain_model_erpuserauth');

    }
);
