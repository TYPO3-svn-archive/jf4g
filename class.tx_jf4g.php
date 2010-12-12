<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Juergen Furrer <juergen.furrer@gmail.com>
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
 * @author	Juergen Furrer <juergen.furrer@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_jf4g
 */
class tx_jf4g
{
	/**
	 * The cObject
	 * @var object
	 */
	public $cObj;

	/**
	 * Return the email-address of the user
	 * @param $content
	 * @param $conf
	 * @return unknown_type
	 */
	public function getEmailAddress($content, $conf)
	{
		$return = $this->getFieldValue('tx_jf4g_email');
		if (t3lib_div::validEmail($return)) {
			return $return;
		} else {
			return 'juergen.furrer@gmail.com';
		}
		
	}

	/**
	 * Add the title of the language to the menuArr
	 * @param $menuArr
	 * @param $conf
	 * @return array
	 */
	public function languageArrayProcFunc($menuArr, $conf)
	{
		$languages = t3lib_div::trimExplode(',', $conf['parentObj']->conf['special.']['value'], true);
		if (count($languages) < 2) {
			return array();
		}
		$defaultLabel = $this->cObj->cObjGetSingle($conf['defaultLabel'], $conf['defaultLabel.']);
		foreach ($languages as $key => $language) {
			if ($language > 0) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('title', 'sys_language', 'uid='.intval($language), '', '', 1);
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				$menuArr[$key]['sys_language-title']= $row['title'];
			} else {
				$menuArr[$key]['sys_language-title'] = $defaultLabel;
			}
		}
		return $menuArr;
	}

	/**
	 * Return the Calendar PID
	 * @param $content
	 * @param $conf
	 * @return integer
	 */
	public function getCalendarPid($content, $conf)
	{
		return $this->getFieldValue('tx_jf4g_calendarpid');
	}

	/**
	 * 
	 * @param $pObj
	 * @param $obj
	 * @return void
	 */
	public function setPageId($pObj, $obj)
	{
		$obj->fetch_the_id();
		if ($obj->page['doktype'] == 30) {
			$shortcut = $obj->getPageShortcut($obj->page['shortcut'], $obj->page['shortcut_mode'], $obj->page['uid']);
			$pObj['pObj']->id = $shortcut['uid'];
		}
	}

	/**
	 * Render the ajax autocomplete
	 * @param $params
	 * @param $obj
	 * @param $empty
	 * @return string
	 */
	public function renderFEUser($params, $obj, $empty)
	{
		$params['entry']['text'] .= '<br /><span class="suggest-address">' . $params['row']['name'] . '<br />' . nl2br($params['row']['address']) . '<br />' . $params['row']['zip'] . $params['row']['city'] . '</span>';
	}

	/**
	 * Logoff the user if not allowed othis site...
	 * @param $params
	 * @param $obj
	 * @return string
	 */
	public function checkAccess($params, $obj)
	{
		$obj->fetch_the_id();
		if ($obj->rootLine[1]['tx_jf4g_allowedpin']) {
			$allowedPins = t3lib_div::trimExplode(',', $obj->rootLine[1]['tx_jf4g_allowedpin'], true);
			if (! in_array($obj->fe_user->user['uid'], $allowedPins)) {
				$obj->fe_user->logoff();
			}
		}
	}

	/**
	 * Return the requested value from rootline 1
	 * @param $key
	 * @return string
	 */
	private function getFieldValue($key)
	{
		if (is_array($GLOBALS['TSFE']->rootLine[1])) {
			return $GLOBALS['TSFE']->rootLine[1][$key];
		}
	}
}


// XCLASS inclusion code
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/class.tx_jf4g.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/class.tx_jf4g.php']);
}
?>