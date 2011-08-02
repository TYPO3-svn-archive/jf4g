<?php
function user_jf4g($type='')
{
	if ($type == 'checktreelevel1') {
		$pageUid = $GLOBALS['SOBE']->id;
		$sysPageObj = t3lib_div::makeInstance('t3lib_pageSelect');
		$rootline = $sysPageObj->getRootLine($pageUid);
		if ($rootline[1]['uid'] == $pageUid) {
			return true;
		}
	}
	return false;
}

?>