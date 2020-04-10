<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManageProductUpload',
            'Pi1',
            '产品上传'
        );

        $pluginSignature = str_replace('_', '', 'erp_manage_product_upload') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_manage_product_upload/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_manage_product_upload', 'Configuration/TypoScript', '产品上传');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanageproductupload_domain_model_upload', 'EXT:erp_manage_product_upload/Resources/Private/Language/locallang_csh_tx_erpmanageproductupload_domain_model_upload.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanageproductupload_domain_model_upload');

    }
);
