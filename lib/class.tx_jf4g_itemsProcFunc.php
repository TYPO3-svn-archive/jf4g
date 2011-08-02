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

require_once (PATH_t3lib . 'class.t3lib_page.php');

/**
 * 'itemsProcFunc' for the 'jf4g' extension.
 *
 * @author     Juergen Furrer <juergen.furrer@gmail.com>
 * @package    TYPO3
 * @subpackage tx_jf4g
 */
class tx_jf4g_itemsProcFunc
{
	/**
	 * Get all modes for image selection
	 * @return array
	 */
	function getStorys($config, $item)
	{
		$optionList = array();
		$query = $GLOBALS['TYPO3_DB']->SELECTquery(
			'uid, title',
			'pages',
			'doktype=30 AND tx_jf4g_publish=1',
			'',
			'title',
			''
		);
		$res = $GLOBALS['TYPO3_DB']->sql_query($query);
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$optionList[] = array(
				$row['title'],
				$row['uid'],
			);
		}
		$config['items'] = array_merge($config['items'], $optionList);
		return $config;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jf4g/lib/class.tx_jf4g_itemsProcFunc.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jf4g/lib/class.tx_jf4g_itemsProcFunc.php']);
}
?>