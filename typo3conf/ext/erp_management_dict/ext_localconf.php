<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ERP.ErpManagementDict',
            'Pi1',
            [
                'Dicttype' => 'list, show, new, create, edit, update, delete',
                'Dictitem' => 'list, show, new, create, edit, update, delete,getVariant,ajax',
                'Region' => 'list, show, new, create, edit, update, delete',
                'Category' => 'list, show, new, create, edit, update, delete,getCategory,getTemplate,ajax'
            ],
            // non-cacheable actions
            [
                'Dicttype' => 'list, show, new, create, edit, update, delete',
                'Dictitem' => 'list, show, new, create, edit, update, delete,getVariant,ajax',
                'Region' => 'list, show, new, create, edit, update, delete',
                'Category' => 'list, show, new, create, edit, update, delete,getCategory,getTemplate,ajax'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = erp_management_dict-plugin-pi1
                        title = LLL:EXT:erp_management_dict/Resources/Private/Language/locallang_db.xlf:tx_erp_management_dict_pi1.name
                        description = LLL:EXT:erp_management_dict/Resources/Private/Language/locallang_db.xlf:tx_erp_management_dict_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = erpmanagementdict_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'erp_management_dict-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:erp_management_dict/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
