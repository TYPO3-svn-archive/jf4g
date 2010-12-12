<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_jf4g_pi1.php', '_pi1', 'list_type', 1);

include_once(t3lib_extMgm::extPath($_EXTKEY).'user_jf4g.php');

// Add HOOK for pagerender
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['checkAlternativeIdMethods-PostProc'][] = "EXT:jf4g/class.tx_jf4g.php:tx_jf4g->setPageId";

// Add HOOK for FE-Usergroup
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['initFEuser'][] = "EXT:jf4g/class.tx_jf4g.php:tx_jf4g->checkAccess";

// Add rootline fields
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ', tx_jf4g_pin, tx_jf4g_allowedpin, tx_jf4g_navigation, tx_jf4g_mystory, tx_jf4g_publish, tx_jf4g_newsid, tx_jf4g_calendarpid, tx_jf4g_languages, tx_jf4g_address, tx_jf4g_email';
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ', subtitle, author, description, keywords';
?>