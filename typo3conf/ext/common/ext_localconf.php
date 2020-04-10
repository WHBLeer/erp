<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Sll.Common',
            'Pi1',
            [
                'Config' => 'list, edit, update, delete, ajax'
            ],
            // non-cacheable actions
            [
                'Config' => 'list, edit, update, delete, ajax'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = common-plugin-pi1
                        title = LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_pi1.name
                        description = LLL:EXT:common/Resources/Private/Language/locallang_db.xlf:tx_common_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = common_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'common-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:common/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
