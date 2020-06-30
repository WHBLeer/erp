<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementPrupload',
            'Pi1',
            '产品上传'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_prupload') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_prupload/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_prupload', 'Configuration/TypoScript', '产品上传');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementprupload_domain_model_upload', 'EXT:erp_management_prupload/Resources/Private/Language/locallang_csh_tx_erpmanagementprupload_domain_model_upload.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementprupload_domain_model_upload');

    }
);
