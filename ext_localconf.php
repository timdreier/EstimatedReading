<?php
defined('TYPO3') || die();

if (!array_key_exists('readingtime_cache', $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['readingtime_cache'] = [];
}