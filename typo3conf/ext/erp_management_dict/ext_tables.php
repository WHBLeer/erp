<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ERP.ErpManagementDict',
            'Pi1',
            '字典管理'
        );

        $pluginSignature = str_replace('_', '', 'erp_management_dict') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:erp_management_dict/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('erp_management_dict', 'Configuration/TypoScript', '数据字典');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementdict_domain_model_dicttype', 'EXT:erp_management_dict/Resources/Private/Language/locallang_csh_tx_erpmanagementdict_domain_model_dicttype.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementdict_domain_model_dicttype');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementdict_domain_model_dictitem', 'EXT:erp_management_dict/Resources/Private/Language/locallang_csh_tx_erpmanagementdict_domain_model_dictitem.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementdict_domain_model_dictitem');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementdict_domain_model_region', 'EXT:erp_management_dict/Resources/Private/Language/locallang_csh_tx_erpmanagementdict_domain_model_region.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementdict_domain_model_region');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_erpmanagementdict_domain_model_category', 'EXT:erp_management_dict/Resources/Private/Language/locallang_csh_tx_erpmanagementdict_domain_model_category.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_erpmanagementdict_domain_model_category');

    }
);
