<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txjf4gM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	t3lib_extMgm::addModule('web', 'txjf4gM1', 'before:info', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

$tempColumns = array(
	'tx_jf4g_navigation' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_navigation',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
	'tx_jf4g_mystory' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_mystory',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
	'tx_jf4g_publish' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_publish',
		'config' => array(
			'type' => 'check',
		)
	),
	'tx_jf4g_address' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_address',
		'config' => array(
			'type' => 'text',
			'cols' => '30',
			'rows' => '5',
		)
	),
	'tx_jf4g_email' => array(
		'exclude' => 1, 
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_email',
		'config' => array(
			'type' => 'input',
			'size' => '48',
			'max' => '255',
			'checkbox' => '',
			'eval' => 'lower',
		)
	),
	'tx_jf4g_feloginstorepid' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_feloginstorepid',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
	'tx_jf4g_newsid' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_newsid',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
	'tx_jf4g_languages' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_languages',
		'config' => array (
			'type' => 'select',
			'foreign_table' => 'sys_language',
			'foreign_table_where' => 'ORDER BY sys_language.uid',
			'size' => 10,
			'minitems' => 0,
			'maxitems' => 100,
		)
	),
);


$doktype = '30';
t3lib_div::loadTCA('pages');
$TCA['pages']['types'][$doktype] = $TCA['pages']['types']['1'];
t3lib_SpriteManager::addTcaTypeIcon('pages', $doktype, t3lib_extMgm::extRelPath($_EXTKEY).'page.png');
$TCA['pages']['columns']['doktype']['config']['items'][] = array('4G', $doktype);

$TCA['pages']['columns']['layout']['config']['items'] = array(
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.0", "0"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.1", "1"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.2", "2"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.3", "3"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.4", "4"),
);
$TCA['pages']['palettes'][2]['canNotCollapse'] = 1;

$TCA['pages']['types']['1'] = array(
	'showitem' =>
		'doktype;;2;;1-1-1, hidden, nav_hide, title;;3;;2-2-2, subtitle, nav_title,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.files,
		media,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.options,
		TSconfig;;6;nowrap;6-6-6, storage_pid;;7, l18n_cfg, module, content_from_pid,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,
		starttime, endtime, fe_login_mode, fe_group, extendToSubpages,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.extended,
	'
);

t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages', '--div--;LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_tab, tx_jf4g_navigation;;;;1-1-1, tx_jf4g_feloginstorepid, tx_jf4g_newsid, tx_jf4g_address;;;richtext[];1-1-1, tx_jf4g_languages, tx_jf4g_email', $doktype, '');
$TCA['pages']['palettes']['tx_jf4g_mystory'] = array(
	'showitem' => 'tx_jf4g_mystory,tx_jf4g_publish',
	'canNotCollapse' => 1,
);
t3lib_extMgm::addToAllTCAtypes('pages', '--palette--;LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_mystorytitel;tx_jf4g_mystory', $doktype, 'after:tx_jf4g_navigation');


?>