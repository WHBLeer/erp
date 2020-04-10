<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementProduct',
            'Pi1',
            '产品管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_product') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_product/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_product', 'Configuration/TypoScript', '产品管理');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementproduct_domain_model_product', 'EXT:erp_management_product/Resources/Private/Language/locallang_csh_tx_erpmanagementproduct_domain_model_product.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementproduct_domain_model_product');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementproduct_domain_model_info', 'EXT:erp_management_product/Resources/Private/Language/locallang_csh_tx_erpmanagementproduct_domain_model_info.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementproduct_domain_model_info');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementproduct_domain_model_cost', 'EXT:erp_management_product/Resources/Private/Language/locallang_csh_tx_erpmanagementproduct_domain_model_cost.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementproduct_domain_model_cost');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementproduct_domain_model_desc', 'EXT:erp_management_product/Resources/Private/Language/locallang_csh_tx_erpmanagementproduct_domain_model_desc.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementproduct_domain_model_desc');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementproduct_domain_model_variants', 'EXT:erp_management_product/Resources/Private/Language/locallang_csh_tx_erpmanagementproduct_domain_model_variants.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementproduct_domain_model_variants');

    }
);
