<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementWorkorder',
            'Pi1',
            '工单管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_workorder') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_workorder/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_workorder', 'Configuration/TypoScript', '工单模块管理');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementworkorder_domain_model_workorder', 'EXT:erp_management_workorder/Resources/Private/Language/locallang_csh_tx_erpmanagementworkorder_domain_model_workorder.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementworkorder_domain_model_workorder');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementworkorder_domain_model_dialogue', 'EXT:erp_management_workorder/Resources/Private/Language/locallang_csh_tx_erpmanagementworkorder_domain_model_dialogue.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementworkorder_domain_model_dialogue');

    }
);
