<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tempColumns = array(
	'tx_jf4g_pin' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_pin',
		'config' => array (
			'type'     => 'input',
			'size'     => '7',
			'max'      => '7',
			'eval'     => 'int',
			'checkbox' => '0',
			'range'    => array (
				'upper' => '9999999',
				'lower' => '1000000'
			),
			'default' => 0,
		)
	),
	'tx_jf4g_allowedpin' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_allowedpin',
		'config' => array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users',
			'size' => 20,
			'minitems' => 0,
			'maxitems' => 1000,
			'wizards' => array(
				'_PADDING'  => 2,
				'_VERTICAL' => 0,
/*
				'add' => array(
					'type'   => 'script',
					'title'  => 'Create new record',
					'icon'   => 'add.gif',
					'params' => array(
						'table'    => 'fe_users',
						'pid'      => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
					'script' => 'wizard_add.php',
				),
*/
				'edit' => array(
					'type'   => 'popup',
					'title'  => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_allowedpin.edit',
					'icon'   => 'edit2.gif',
					'script' => 'wizard_edit.php',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1',
				),

				'suggest' => array(
					'type' => 'suggest',
				),
			),
		)
	),
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
	'tx_jf4g_calendarpid' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_calendarpid',
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
$TCA['pages']['types'][$doktype] = $TCA['pages']['types'][4];
$TCA['pages']['types'][$doktype] = array(
	'showitem' =>
		'doktype;;2;;1-1-1, hidden, nav_hide, title;;3;;2-2-2, subtitle, nav_title,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.metadata,
		abstract;;5;;3-3-3, keywords, description,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.files,
		media,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,
		starttime, endtime, fe_login_mode, fe_group, extendToSubpages,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.options,
		TSconfig;;6;nowrap;6-6-6, storage_pid;;7, l18n_cfg, module, content_from_pid,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.extended,
');

t3lib_SpriteManager::addTcaTypeIcon('pages', $doktype, t3lib_extMgm::extRelPath($_EXTKEY).'page.png');
$TCA['pages']['columns']['doktype']['config']['items'][] = array('4G', $doktype);

$TCA['pages']['columns']['layout']['config']['items'] = array(
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.0", "0"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.1", "1"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.2", "2"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.3", "3"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.4", "4"),
	array("LLL:EXT:jf4g/locallang_db.xml:pages.layout.I.5", "5"),
);
$TCA['pages']['palettes'][2]['canNotCollapse'] = 1;

$TCA['pages']['types'][1] = array(
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
t3lib_extMgm::addToAllTCAtypes('pages', '--div--;LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_tab, tx_jf4g_pin, tx_jf4g_navigation;;;;1-1-1, tx_jf4g_newsid, tx_jf4g_calendarpid, tx_jf4g_address;;;richtext[];1-1-1, tx_jf4g_languages, tx_jf4g_email, tx_jf4g_allowedpin', $doktype, '');
$TCA['pages']['palettes']['tx_jf4g_mystory'] = array(
	'showitem' => 'tx_jf4g_mystory,tx_jf4g_publish',
	'canNotCollapse' => 1,
);
t3lib_extMgm::addToAllTCAtypes('pages', '--palette--;LLL:EXT:jf4g/locallang_db.xml:pages.tx_jf4g_mystorytitel;tx_jf4g_mystory', $doktype, 'after:tx_jf4g_navigation');


/* FE User suche */
$GLOBALS['TCA']['fe_users']['ctrl']['label_alt'] = 'name, first_name, middle_name, last_name';
t3lib_extMgm::addPageTSConfig("TCEFORM.suggest.fe_users.renderFunc = EXT:jf4g/class.tx_jf4g.php:&tx_jf4g->renderFEUser");



// Static
t3lib_extMgm::addStaticFile($_EXTKEY, 'pi1/static/', 'MyStory');


// tt_content
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';


// ICON
t3lib_extMgm::addPlugin(array(
	'LLL:EXT:jf4g/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY.'/pi1/flexform_ds.xml');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_jf4g_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_jf4g_pi1_wizicon.php';
}


require_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_jf4g_itemsProcFunc.php');


?>