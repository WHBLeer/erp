<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManageProductTemplate',
            'Pi1',
            '产品模板'
        );

        $pluginSignature = str_replace('_', '', 'erp_manage_product_template') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_manage_product_template/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_manage_product_template', 'Configuration/TypoScript', '产品模板');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanageproducttemplate_domain_model_template', 'EXT:erp_manage_product_template/Resources/Private/Language/locallang_csh_tx_erpmanageproducttemplate_domain_model_template.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanageproducttemplate_domain_model_template');

    }
);
