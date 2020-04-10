<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ERP.ErpManagementUser',
            'Pi1',
            [
                'UserManagement' => 'list, show, new, create, edit, update, delete, register, changepwd, retrievepwd, check, ajaxdata'
            ],
            // non-cacheable actions
            [
                'UserManagement' => 'list, show, new, create, edit, update, delete, register, changepwd, retrievepwd, check, ajaxdata'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = erp_management_user-plugin-pi1
                        title = LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erp_management_user_pi1.name
                        description = LLL:EXT:erp_management_user/Resources/Private/Language/locallang_db.xlf:tx_erp_management_user_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = erpmanagementuser_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'erp_management_user-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:erp_management_user/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
