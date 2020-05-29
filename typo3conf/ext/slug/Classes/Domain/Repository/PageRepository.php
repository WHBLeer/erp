<?php
namespace SIMONKOEHLER\Slug\Domain\Repository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

class PageRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    protected $table = 'pages';
    protected $fieldName = 'slug';
    protected $languages;

    public function findAllFiltered($filterVariables) {
        $this->languages = $this->getLanguages();
        $queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('pages');
        $query = $queryBuilder
            ->select('*')
            ->from('pages')
            ->orderBy($filterVariables['orderby'],$filterVariables['order']);

        if($filterVariables['key']){
            $query->where(
                $queryBuilder->expr()->like('slug',$queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($filterVariables['key']) . '%'))
            );
        }
        $sitefinder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(SiteFinder::class);
        $statement = $query->execute();
        $output = array();
        while ($row = $statement->fetch()) {
            try {
                $site = $sitefinder->getSiteByPageId($row['uid']);
                $row['site'] = $site;
                $row['hasSite'] = true;
            } catch (SiteNotFoundException $e) {
               $row['hasSite'] = false;
            }
            $row['flag'] = $this->getFlagIconByLanguageUid($row['sys_language_uid']);
            $row['isocode'] = $this->getIsoCodeByLanguageUid($row['sys_language_uid']);
            array_push($output, $row);
        }
        return $output;
    }


    private function getFlagIconByLanguageUid($sys_language_uid) {
        foreach ($this->languages as $value) {
            if($value['uid'] === $sys_language_uid){
                $output = $value['flag'];
                break;
            }
            elseif($sys_language_uid === 0){
                $output = 'multiple';
                break;
            }
        }
        return $output;
    }


    private function getIsoCodeByLanguageUid($sys_language_uid) {
        foreach ($this->languages as $value) {
            if($value['uid'] === $sys_language_uid){
                $output = $value['language_isocode'];
                break;
            }
            elseif($sys_language_uid === 0){
                $output = '';
                break;
            }
        }
        return $output;
    }


    public function getLanguages(){
        $queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('sys_language');
        $statement = $queryBuilder
            ->select('*')
            ->from('sys_language')
            ->execute();
        $output = array();
        while ($row = $statement->fetch()) {
            array_push($output, $row);
        }
        return $output;
    }

}
