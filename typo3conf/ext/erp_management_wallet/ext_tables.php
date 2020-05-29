<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementWallet',
            'Pi1',
            '钱包管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_wallet') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_wallet/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_wallet', 'Configuration/TypoScript', '钱包模块管理');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementwallet_domain_model_record', 'EXT:erp_management_wallet/Resources/Private/Language/locallang_csh_tx_erpmanagementwallet_domain_model_record.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementwallet_domain_model_record');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementwallet_domain_model_log', 'EXT:erp_management_wallet/Resources/Private/Language/locallang_csh_tx_erpmanagementwallet_domain_model_log.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementwallet_domain_model_log');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementwallet_domain_model_wallet', 'EXT:erp_management_wallet/Resources/Private/Language/locallang_csh_tx_erpmanagementwallet_domain_model_wallet.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementwallet_domain_model_wallet');

    }
);
