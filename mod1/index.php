<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010  <juergen.furrer@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


$LANG->includeLLFile('EXT:jf4g/mod1/locallang.xml');
require_once(PATH_t3lib . 'class.t3lib_scbase.php');
// This checks permissions and exits if the users has no permission for entry.
$BE_USER->modAccess($MCONF, 1);


/**
 * Module '4G' for the 'jf4g' extension.
 *
 * @author	   <juergen.furrer@gmail.com>
 * @package    TYPO3
 * @subpackage tx_jf4g
 */
class tx_jf4g_module1 extends t3lib_SCbase
{
	private $pageinfo;
	private $BE_USER;
	private $LANG;
	private $BACK_PATH;
	private $TCA_DESCR;
	private $TCA;
	private $CLIENT;
	private $TYPO3_CONF_VARS;

	/**
	 * Initializes the Module
	 * @return	void
	 */
	public function init()
	{
		$this->BE_USER         = $GLOBALS['BE_USER'];
		$this->LANG            = $GLOBALS['LANG'];
		$this->BACK_PATH       = $GLOBALS['BACK_PATH'];
		$this->TCA_DESCR       = $GLOBALS['TCA_DESCR'];
		$this->TCA             = $GLOBALS['TCA'];
		$this->CLIENT          = $GLOBALS['CLIENT'];
		$this->TYPO3_CONF_VARS = $GLOBALS['TYPO3_CONF_VARS'];
		parent::init();
		/*
		if (t3lib_div::_GP('clear_all_cache'))	{
			$this->include_once[] = PATH_t3lib.'class.t3lib_tcemain.php';
		}
		*/
	}

	/**
	 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
	 *
	 * @return	void
	 */
	public function menuConfig()
	{
		$this->MOD_MENU = Array (
			'function' => Array (
				'1' => $this->LANG->getLL('function1'),
				'2' => $this->LANG->getLL('function2'),
				'3' => $this->LANG->getLL('function3'),
			)
		);
		parent::menuConfig();
	}

	/**
	 * Return the TCA of a gifen form item
	 * @param $table
	 * @param $theUid
	 * @param $isNew
	 * @return array
	 */
	private function getTCEFormArray($table,$theUid, $isNew = false)
	{
		$trData = t3lib_div::makeInstance('t3lib_transferData');
		$trData->addRawData = TRUE;
		$trData->fetchRecord($table, $theUid, ($isNew ? 'new' : ''));
		reset($trData->regTableItems_data);
		return $trData->regTableItems_data;
	}

	/**
	 * Main function of the module. Write the content to $this->content
	 * If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
	 *
	 * @return void
	 */
	public function main()
	{
		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id, $this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;

		$this->doc = t3lib_div::makeInstance('mediumDoc');
		$this->doc->backPath = $this->BACK_PATH;

		if (($this->id && $access) || ($this->BE_USER->user['admin'] && !$this->id)) {

			// Draw the header
			$this->doc->form = '<form action="" method="post" enctype="multipart/form-data">';

				// JavaScript
			$this->doc->JScode = '
<script language="javascript" type="text/javascript">
script_ended = 0;
function jumpToUrl(URL) {
	document.location = URL;
}
</script>';
			$this->doc->postCode='
<script language="javascript" type="text/javascript">
script_ended = 1;
if (top.fsMod) {
	top.fsMod.recentIds["web"] = 0;
}
</script>';

			$headerSection = $this->doc->getHeader('pages',$this->pageinfo,$this->pageinfo['_thePath']).'<br />'.$this->LANG->sL('LLL:EXT:lang/locallang_core.xml:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);

			$this->content .= $this->doc->startPage($this->LANG->getLL('title'));
			$this->content .= $this->doc->header($this->LANG->getLL('title'));
			$this->content .= $this->doc->spacer(5);
			$this->content .= $this->doc->section('', $this->doc->funcMenu($headerSection, t3lib_BEfunc::getFuncMenu($this->id, 'SET[function]', $this->MOD_SETTINGS['function'], $this->MOD_MENU['function'])));
			$this->content .= $this->doc->divider(5);

			// Render content:
			$this->moduleContent();

			// ShortCut
			if ($this->BE_USER->mayMakeShortcut()) {
				$this->content .= $this->doc->spacer(20).$this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)), $this->MCONF['name']));
			}

			$this->content .= $this->doc->spacer(10);
		} else {
			// If no access or if ID == zero
			$this->content .= $this->doc->startPage($this->LANG->getLL('title'));
			$this->content .= $this->doc->header($this->LANG->getLL('title'));
			$this->content .= $this->doc->spacer(5);
			$this->content .= $this->doc->spacer(10);
		}
	}

	/**
	 * Prints out the module HTML
	 *
	 * @return	void
	 */
	public function printContent()
	{
		$this->content .= $this->doc->endPage();
		echo $this->content;
	}

	/**
	 * Generates the module content
	 *
	 * @return	void
	 */
	private function moduleContent()
	{
		switch((string)$this->MOD_SETTINGS['function']) {
			case 1 : {
				// generate the form
				$form = t3lib_div::makeInstance('t3lib_TCEforms');
				$form->initDefaultBEmode();
				$form->backPath = $this->BACK_PATH;
				// 
				$dataArr = $this->getTCEFormArray('pages', $this->id);
				$this->doc->loadJavascriptLib('contrib/prototype/prototype.js');
				// process all values
				$fieldsArray = array('tx_jf4g_navigation', 'tx_jf4g_mystory', 'tx_jf4g_publish', 'tx_jf4g_address');
				foreach ($fieldsArray as $fieldname) {
					$modContent = $form->getSoloField('pages', $dataArr['pages_'.$this->id], $fieldname); 
					$content .= $form->printNeededJSFunctions_top();
					$content .= $modContent;
					$content .= $form->printNeededJSFunctions();
				}
				// 
				$content = $this->doc->insertStylesAndJS($content);
				$this->content .= $this->doc->section('Text:', $content, 0, 1);
				break;
			}
			case 2 : {
				$content = '<div align=center><strong>Menu item #2...</strong></div>';
				$this->content .= $this->doc->section('Message #2:', $content, 0, 1);
				break;
			}
			case 3 : {
				$content = '<div align=center><strong>Menu item #3...</strong></div>';
				$this->content .= $this->doc->section('Message #3:', $content, 0, 1);
				break;
			}
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jf4g/mod1/index.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jf4g/mod1/index.php']);
}


// Make instance:
$SOBE = t3lib_div::makeInstance('tx_jf4g_module1');
$SOBE->init();

// Include files?
foreach ($SOBE->include_once as $INC_FILE) {
	include_once($INC_FILE);
}

$SOBE->main();
$SOBE->printContent();

?>