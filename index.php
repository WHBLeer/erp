<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

// Exit early if php requirement is not satisfied.
if (PHP_VERSION_ID < 70200) {
    die('This version of TYPO3 CMS requires PHP 7.2 or above');
}

// Set up the application for the frontend
call_user_func(function () {
    $classLoader = require __DIR__.'/vendor/autoload.php';
    \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::run(0, \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_FE);
    \TYPO3\CMS\Core\Core\Bootstrap::init($classLoader)->get(\TYPO3\CMS\Frontend\Http\Application::class)->run();
});

/**
 * typo3输出
 *
 * @param [type] $res
 * @return void
 * @author wanghongbin
 * tstamp: 2020-03-19
 */
function dump($res=null)
{
    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($res);
}

/**
 * 请求SQL输出
 *
 * @param [type] $query
 * @return void
 * @author wanghongbin
 * tstamp: 2020-03-19
 */
function dumpsql($query=null)
{
    $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
    $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters());
}

/**
 * JSON输出（兼容中文）
 *
 * @param array $array
 * @return void
 * @author wanghongbin <wanghongbin@ngoos.org>
 * @since
 */
function JSON($array=array()) {
    header('Content-Type: application/json');
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    exit(urldecode($json));
}

/**
 * 使用特定function对数组中所有元素做处理
 *
 * @param [type] $array 要处理的字符串
 * @param [type] $function 要执行的函数
 * @param boolean $apply_to_keys_also 是否也应用到key上
 * @return void
 * @author wanghongbin <wanghongbin@ngoos.org>
 * @since
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++$recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}