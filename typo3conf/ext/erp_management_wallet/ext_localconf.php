<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ERP.ErpManagementWallet',
            'Pi1',
            [
                'Wallet' => 'list, show, index',
                'Log' => 'list, syslist, show, new, create, edit, update, delete',
                'Record' => 'list, syslist, show, new, create, edit, update, delete, callback, success'
            ],
            // non-cacheable actions
            [
                'Wallet' => 'list, show, index',
                'Log' => 'list, syslist, show, new, create, edit, update, delete',
                'Record' => 'list, syslist, show, new, create, edit, update, delete, callback, success'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = erp_management_wallet-plugin-pi1
                        title = LLL:EXT:erp_management_wallet/Resources/Private/Language/locallang_db.xlf:tx_erp_management_wallet_pi1.name
                        description = LLL:EXT:erp_management_wallet/Resources/Private/Language/locallang_db.xlf:tx_erp_management_wallet_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = erpmanagementwallet_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'erp_management_wallet-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:erp_management_wallet/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
