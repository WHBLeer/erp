<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageNotFoundHandling
{

    /**
     * @param $param
     * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $ref
     */
    public function pageNotFound(&$param, &$ref)
    {
        var_dump('404');exit;
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'pageNotFoundFunction') !== false) {
            header('HTTP/1.1 404 Not Found');
            echo "<h1>404 Not Found</h1>";
            echo "<p>404 Seite konnte nicht gefunden werden</p>";
            if (isset($_GET['L']) && (int)$_GET['L'] != 0) {
                echo "<p>Möglicherweise wurde die 404 Seite nicht übersetzt.</p>";
            }
            die();
        }
        $page404 = $GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling_redirectPageID'];

        $url = GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . 'index.php?id=' . $page404;
        if ($ref->sys_language_uid > 0) {
            $url .= '&L=' . $ref->sys_language_uid;
        } else {
            // Workaround of realurl limitation
            if (
                isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'][0]['GETvar'])
                && isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'][0]['valueMap'])
                && $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'][0]['GETvar'] == 'L'
                && is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'][0]['valueMap'])
            ) {
                $vMap = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'][0]['valueMap'];
                $currentUrl = $param['currentUrl'];
                foreach ($vMap as $key => $value) {
                    $prefix = '/'.$key.'/';
                    if (strpos($currentUrl, $prefix) === 0) {
                        $url .= '&L=' . $value;
                        break;
                    }
                }
            }
        }

        $_buffer = $this->loadPage($url);
        echo $_buffer;
    }

    /**
     * @param $url
     * @return mixed
     */
    protected function loadPage($url)
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];
        $parsedUrl['host'] = 'localhost';
        $parsedUrl['scheme'] = 'http';
        if (function_exists('http_build_url')) {
            $url = http_build_url($parsedUrl);
        } else {
            $url = $parsedUrl['scheme'] . '://'
                . $parsedUrl['host']
                . $parsedUrl['path']
                . (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');
        }

        $agent = "TYPO3 pageNotFoundFunction v1.0";
        $header[] = "Accept: text/vnd.wap.wml,*.*";
        $header[] = "Host: " . $host;
        $ch = curl_init($url);

        $tmp = '';
        if ($ch) {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            $tmp = curl_exec($ch);

            if (false == $tmp) {
                print_r(curl_error($ch));
            }

            curl_close($ch);
        }

        return $tmp;
    }
}
