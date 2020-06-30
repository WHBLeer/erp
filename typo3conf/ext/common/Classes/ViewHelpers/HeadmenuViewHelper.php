<?php
namespace Sll\Common\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
/**
 * 顶部菜单
 *
 * @author wanghongbin
 * tstamp: 2020-06-08
 */
class HeadmenuViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{
	/**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
		$this->registerArgument('parentid', 'int', '节点pid');
    }
	
	/**
	 * 顶部菜单
	 * 
	 * @return string 
	 */
	public function render() 
	{
		$queryBuilder =GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
		$pages = $queryBuilder
			->select('uid', 'pid', 'sorting', 'title', 'slug')
			->from('pages')
			->where(
				$queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($this->arguments['parentid'], \PDO::PARAM_INT)),
				$queryBuilder->expr()->eq('nav_hide', $queryBuilder->createNamedParameter(1)),
				$queryBuilder->expr()->eq('doktype', $queryBuilder->createNamedParameter(4)),
				$queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0))
			)
			->orderBy('sorting')
			->execute()
			->fetchAll();

		$html ="<div class=\"system-navigation\">";
		foreach ($pages as $k => $page) {
			$html .="<span>";
			$html .="	<a href=\"/erp".$page['slug']."\" target=\"_blank\">".$page['title']."</a>";
			$html .="</span>";
		}
		$html .="</div>";
		return $html;
	}
}

?>