<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        if (TYPO3_MODE === 'BE') {

            /***************
             * Make the extension configuration accessible
             */
            $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
            );
            $slugConfiguration = $extensionConfiguration->get('slug');


            // The main site module for slug editing
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'SIMONKOEHLER.Slug',
                'site',
                'slugs',
                '',
                [
                    'Page' => 'list,site,tree',
                    'Extension' => 'additionalTable',
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:slug/Resources/Public/Icons/slug-be-module.svg',
                    'labels' => 'LLL:EXT:slug/Resources/Private/Language/locallang_slugs.xlf',
                ]
            );


        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('slug', 'Configuration/TypoScript', 'Slug');
    }
);
