<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementInteraction',
            'Pi1',
            '接口管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_interaction') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_interaction/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_interaction', 'Configuration/TypoScript', '接口管理');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementinteraction_domain_model_interaction', 'EXT:erp_management_interaction/Resources/Private/Language/locallang_csh_tx_erpmanagementinteraction_domain_model_interaction.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementinteraction_domain_model_interaction');

    }
);
