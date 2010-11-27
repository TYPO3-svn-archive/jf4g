<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

include_once(t3lib_extMgm::extPath($_EXTKEY).'user_jf4g.php');

//t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_jfheaderslide_pi1.php', '_pi1', 'list_type', 1);
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ', tx_jf4g_navigation, tx_jf4g_mystory, tx_jf4g_publish, tx_jf4g_feloginstorepid, tx_jf4g_newsid, tx_jf4g_languages, tx_jf4g_address, tx_jf4g_email';
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ', subtitle, author, description, keywords';
?>