<?php
// $Id$
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
/**
 * Function used to display an horizontal menu inside the admin panel
 *
 * Enable webmasters to navigate thru the module's features.
 * Each time you select an option in the admin panel of the news module, this option is highlighted in this menu
 *
 * @package News
 * @author - stolen to the Newbb team ;-)
 * @copyright	(c) The Xoops Project - www.xoops.org
*/
function adminmenu($currentoption = 0, $breadcrumb = '')
{
	/* Nice buttons styles */
	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/news/images/bg.png') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/news/images/left_both.png') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/news/images/right_both.png') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
 	global $xoopsModule, $xoopsConfig;

	$tblColors = array('','','','','','','','','');
	if($currentoption>=0) {
		$tblColors[$currentoption] = 'current';
	}

	if (file_exists(XOOPS_ROOT_PATH . '/modules/news/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once XOOPS_ROOT_PATH. '/modules/news/language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once XOOPS_ROOT_PATH . '/modules/news/language/english/modinfo.php';
	}
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		// Cube Legacy without altsys
		$pref_url = XOOPS_URL.'/modules/legacy/admin/index.php?action=PreferenceEdit&confmod_id=' . $xoopsModule->getvar('mid');
	} else {
		// system->preferences
		$pref_url = XOOPS_URL.'/modules/system/admin.php?fct=preferences&op=showmod&mod=' . $xoopsModule->getvar('mid');
	}

	echo "<div id='buttontop'>";
	echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	echo "<td style=\"width: 60%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">
		<a class=\"nobutton\" href=\"".$pref_url."\">"
			._AM_NEWS_GENERALSET . "</a> | 
		<a href=\"../index.php\">" . _AM_NEWS_GOTOMOD . "</a> | 
		<a href=\"#\">" . _AM_NEWS_HELP . "</a>
		</td>";
	echo "<td style=\"width: 40%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>" . $xoopsModule->name() . "  " . _AM_NEWS_MODULEADMIN . "</b> " . $breadcrumb . "</td>";
	echo "</tr></table>";
	echo "</div>";

	echo "<div id='buttonbar'>";
	echo "<ul>";
	echo "<li id='" . $tblColors[0] . "'><a href=\"index.php?op=topicsmanager\"\"><span>"._MI_NEWS_ADMENU2 ."</span></a></li>\n";
	echo "<li id='" . $tblColors[1] . "'><a href=\"index.php?op=newarticle\"><span>" . _MI_NEWS_ADMENU3 . "</span></a></li>\n";
	echo "<li id='" . $tblColors[2] . "'><a href=\"groupperms.php\"><span>" . _MI_NEWS_GROUPPERMS . "</span></a></li>\n";
	echo "<li id='" . $tblColors[3] . "'><a href=\"index.php?op=prune\"><span>" . _MI_NEWS_PRUNENEWS . "</span></a></li>\n";
	echo "<li id='" . $tblColors[4] . "'><a href=\"index.php?op=export\"><span>" . _MI_NEWS_EXPORT . "</span></a></li>\n";
	echo "<li id='" . $tblColors[5] . "'><a href=\"index.php?op=configurenewsletter\"><span>" . _MI_NEWS_NEWSLETTER . "</span></a></li>\n";
	echo "<li id='" . $tblColors[6] . "'><a href=\"index.php?op=stats\"><span>" . _MI_NEWS_STATS . "</span></a></li>\n";
	if ($xoopsModule->getVar('version') != 144) {
		echo "<li id='" . $tblColors[7] . "'><a href=\"upgrade.php\"><span>" . _AM_NEWS_UPGRADE . "</span></a></li>\n";
	}
	echo "</ul></div>";
	echo "<br clear='all' />";
}



function news_collapsableBar($tablename = '', $iconname = '')
{

    ?>
	<script type="text/javascript"><!--
	function goto_URL(object)
	{
		window.location.href = object.options[object.selectedIndex].value;
	}

	function toggle(id)
	{
		if (document.getElementById) { obj = document.getElementById(id); }
		if (document.all) { obj = document.all[id]; }
		if (document.layers) { obj = document.layers[id]; }
		if (obj) {
			if (obj.style.display == "none") {
				obj.style.display = "";
			} else {
				obj.style.display = "none";
			}
		}
		return false;
	}

	var iconClose = new Image();
	iconClose.src = '../images/close12.gif';
	var iconOpen = new Image();
	iconOpen.src = '../images/open12.gif';

	function toggleIcon ( iconName )
	{
		if ( document.images[iconName].src == window.iconOpen.src ) {
			document.images[iconName].src = window.iconClose.src;
		} else if ( document.images[iconName].src == window.iconClose.src ) {
			document.images[iconName].src = window.iconOpen.src;
		}
		return;
	}

	//-->
	</script>
	<?php
	echo "<h4 style=\"color: #2F5376; margin: 6px 0 0 0; \"><a href='#' onClick=\"toggle('" . $tablename . "'); toggleIcon('" . $iconname . "');\">";
}

?>
