<?php
namespace SIMONKOEHLER\Slug\Controller;
use SIMONKOEHLER\Slug\Utility\HelperUtility;
use SIMONKOEHLER\Slug\Domain\Repository\ExtensionRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

class ExtensionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
    * @var ExtensionRepository
    */
    public $extensionRepository;

    /**
    * @var HelperUtility
    */
    public $helper;
    protected $backendConfiguration;


    /**
    * @param ExtensionRepository $extensionRepository
    */
    public function __construct(ExtensionRepository $extensionRepository) {
         $this->extensionRepository = $extensionRepository;
         $this->helper = GeneralUtility::makeInstance(HelperUtility::class);
         $this->backendConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('slug');
    }

    public function additionalTableAction() {

        $backendConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('slug');

         // Check if filter variables are available, otherwise set default values from ExtensionConfiguration
        if($this->request->hasArgument('filter')){
            $filterVariables = $this->request->getArgument('filter');
        }
        else{
            $filterVariables['maxentries'] = $backendConfiguration['recordMaxEntries'];
            $filterVariables['orderby'] = $backendConfiguration['recordOrderBy'];
            $filterVariables['order'] = $backendConfiguration['recordOrder'];
            $filterVariables['key'] = '';
        }

        $filterOptions['order'] = [
            ['value' => 'DESC', 'label' => $this->helper->getLangKey('filter.form.select.option.descending')],
            ['value' => 'ASC', 'label' => $this->helper->getLangKey('filter.form.select.option.ascending')]
        ];

        $filterOptions['maxentries'] = [
            ['value' => '10', 'label' => '10'],
            ['value' => '20', 'label' => '20'],
            ['value' => '30', 'label' => '30'],
            ['value' => '40', 'label' => '40'],
            ['value' => '50', 'label' => '50'],
            ['value' => '60', 'label' => '60'],
            ['value' => '70', 'label' => '70'],
            ['value' => '80', 'label' => '80'],
            ['value' => '90', 'label' => '90'],
            ['value' => '100', 'label' => '100'],
            ['value' => '150', 'label' => '150'],
            ['value' => '200', 'label' => '200'],
            ['value' => '300', 'label' => '300'],
            ['value' => '400', 'label' => '400'],
            ['value' => '500', 'label' => '500']
        ];

        if($this->request->hasArgument('table')){
            $table = $this->request->getArgument('table');
            if($this->extensionRepository->tableExists($table)){

                // Set the order by options for fluid viewhelper f:form.switch
                $filterOptions['orderby'] = [
                    ['value' => 'crdate', 'label' => $this->helper->getLangKey('filter.form.select.option.creation_date')],
                    ['value' => $this->settings['additionalTables'][$table]['titleField'], 'label' => $this->helper->getLangKey('filter.form.select.option.title')],
                    ['value' => $this->settings['additionalTables'][$table]['slugField'], 'label' => $this->helper->getLangKey('filter.form.select.option.path_segment')],
                    ['value' => 'sys_language_uid', 'label' => $this->helper->getLangKey('filter.form.select.option.sys_language_uid')],
                ];

                $records = $this->extensionRepository->getAdditionalRecords(
                        $table,
                        $filterVariables,
                        $this->settings['additionalTables']
                        );

                $this->view->assignMultiple([
                    'filter' => $filterVariables,
                    'filterOptions' => $filterOptions,
                    'records' => $records,
                    'table' => $table,
                    'slugField' => $this->settings['additionalTables'][$table]['slugField'],
                    'titleField' => $this->settings['additionalTables'][$table]['titleField'],
                    'label' => $this->settings['additionalTables'][$table]['label']
                ]);
            }
            else{
                $this->view->assignMultiple([
                    'message' => "Table doesn't exist!"
                ]);
            }
        }
        else{
            $this->view->assignMultiple([
                'message' => "Table argument not given!"
            ]);
        }

        $this->view->assignMultiple([
            'backendConfiguration' => $backendConfiguration,
            'additionalTables' => $this->settings['additionalTables'],
            'extEmconf' => $this->helper->getEmConfiguration('slug'),
        ]);

    }

}
