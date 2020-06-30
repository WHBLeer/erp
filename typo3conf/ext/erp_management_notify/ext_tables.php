<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementNotify',
            'Pi1',
            '消息通知系统'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_notify') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_notify/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_notify', 'Configuration/TypoScript', '消息通知系统');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementnotify_domain_model_message', 'EXT:erp_management_notify/Resources/Private/Language/locallang_csh_tx_erpmanagementnotify_domain_model_message.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementnotify_domain_model_message');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementnotify_domain_model_receive', 'EXT:erp_management_notify/Resources/Private/Language/locallang_csh_tx_erpmanagementnotify_domain_model_receive.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementnotify_domain_model_receive');

    }
);
