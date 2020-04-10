<?php

use TYPO3\CMS\Core\Utility\GeneralUtility;

class user_pageNotFound {
	/**
	 * Detect language and redirect to 404 error page
	 *
	 * @param array $params "currentUrl", "reasonText" and "pageAccessFailureReasons"
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $tsfeObj
	 */
	public function pageNotFound($params, $tsfeObj) {
        $requestUrl = GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST');
		dump($requestUrl);
		$httpCode = $this->getRequestHttpCode($url);
		dump($httpCode);
		/*
		 * If a non-existing page with a RealURL path was requested (www.mydomain.tld/foobar), a fe_group value for an empty
		 * key is set:
		 * $params['pageAccessFailureReasons']['fe_group'][null] = 0;
		 * This is the reason why the second check was implemented.
		 */
		if (!empty($params['pageAccessFailureReasons']['fe_group']) && !array_key_exists(null, $params['pageAccessFailureReasons']['fe_group'])) {
			// page access failed because of missing permissions
			header('HTTP/1.0 403 Forbidden');
			$this->initTSFE(1);
			/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObj */
			$cObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
			$loginUrl = $cObj->typoLink_URL(array(
				'parameter' => $GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling_loginPageID'],
				'useCacheHash' => FALSE,
				'forceAbsoluteUrl' => TRUE,
				'additionalParams' => '&redirect_url=' . $params['currentUrl']
			));
			TYPO3\CMS\Core\Utility\HttpUtility::redirect($loginUrl);
		} else {
			// page not found
			// get first realurl configuration array (important for multidomain)
			$realurlConf = array_shift($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']);
			// look for language configuration
			foreach ($realurlConf['preVars'] as $conf) {
				if ($conf['GETvar'] == 'L') {
					foreach ($conf['valueMap'] as $k => $v) {
						// if the key is empty (e.g. default language without prefix), break
						if (empty($k)) {
							continue;
						}
						// we expect a part like "/de/" in requested url
						if (GeneralUtility::isFirstPartOfStr($params['currentUrl'], '/' . $k . '/')) {
							$tsfeObj->pageErrorHandler('/index.php?id=' . $GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling_redirectPageID'] . '&L=' . $v);
						}
					}
				}
			}
			// handle default language
			$tsfeObj->pageErrorHandler('/index.php?id=' . $GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling_redirectPageID']);
		}
	}

    protected function getRequestHttpCode($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode;
    }
	/**
	 * Initializes a TypoScript Frontend necessary for using TypoScript and TypoLink functions
	 *
	 * @param int $id
	 * @param int $typeNum
	 */
	protected function initTSFE($id = 1, $typeNum = 0) {
		\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
		if (!is_object($GLOBALS['TT'])) {
			$GLOBALS['TT'] = new \TYPO3\CMS\Core\TimeTracker\NullTimeTracker;
			$GLOBALS['TT']->start();
		}

		$GLOBALS['TSFE'] = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController',  $GLOBALS['TYPO3_CONF_VARS'], $id, $typeNum);
		$GLOBALS['TSFE']->sys_page = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		$GLOBALS['TSFE']->sys_page->init(TRUE);
		$GLOBALS['TSFE']->connectToDB();
		$GLOBALS['TSFE']->initFEuser();
		$GLOBALS['TSFE']->determineId();
		$GLOBALS['TSFE']->initTemplate();
		$GLOBALS['TSFE']->rootLine = $GLOBALS['TSFE']->sys_page->getRootLine($id, '');
		$GLOBALS['TSFE']->getConfigArray();

		if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')) {
			$rootline = \TYPO3\CMS\Backend\Utility\BackendUtility::BEgetRootLine($id);
			$host = \TYPO3\CMS\Backend\Utility\BackendUtility::firstDomainRecord($rootline);
			$_SERVER['HTTP_HOST'] = $host;
		}
	}

}