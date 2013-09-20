<?php
// $Id: submit.php,v 1.23 2004/09/01 17:48:07 hthouzard Exp $
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
if (!defined('XOOPS_ROOT_PATH')) {
	include_once '../../mainfile.php';
}
include_once XOOPS_ROOT_PATH . '/modules/news/class/class.newsstory.php';
include_once XOOPS_ROOT_PATH . '/modules/news/class/class.sfiles.php';
include_once XOOPS_ROOT_PATH . '/modules/news/class/class.newstopic.php';
include_once XOOPS_ROOT_PATH . '/class/uploader.php';
include_once XOOPS_ROOT_PATH . '/header.php';
include_once XOOPS_ROOT_PATH . '/modules/news/include/functions.php';
include_once XOOPS_ROOT_PATH . '/modules/news/include/fileup.inc.php'; // by yoshis
if (file_exists(XOOPS_ROOT_PATH . '/modules/news/language/' . $xoopsConfig['language'] . '/admin.php')) {
	include_once XOOPS_ROOT_PATH . '/modules/news/language/' . $xoopsConfig['language'] . '/admin.php';
} else {
	include_once XOOPS_ROOT_PATH . '/modules/news/language/english/admin.php';
}
$myts =& MyTextSanitizer::getInstance();
$module_id = $xoopsModule->getVar('mid');
$storyid = 0;

if (is_object($xoopsUser)) {
	$groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

$gperm_handler =& xoops_gethandler('groupperm');

if (isset($_POST['topic_id'])) {
	$perm_itemid = intval($_POST['topic_id']);
} else {
	$perm_itemid = 0;
}
//If no access
if (!$gperm_handler->checkRight("news_submit", $perm_itemid, $groups, $module_id)) {
	redirect_header(XOOPS_URL . '/modules/news/index.php', 3, _NOPERM);
	exit();
}
$op = 'form';

//If approve privileges
$approveprivilege = 0;
if (is_object($xoopsUser) && $gperm_handler->checkRight("news_approve", $perm_itemid, $groups, $module_id)) {
	$approveprivilege = 1;
}

if (isset($_POST['preview'])) {
	$op = 'preview';
} elseif (isset($_POST['post'])) {
	$op = 'post';
} elseif (isset($_GET['op']) && isset($_GET['storyid'])) {
	// Verify that the user can edit or delete an article
	if ($_GET['op'] == 'edit' || $_GET['op'] == 'delete') {
		if ($xoopsModuleConfig['authoredit'] == 1) {
			$tmpstory = new NewsStory(intval($_GET['storyid']));
			if (is_object($xoopsUser) && $xoopsUser->getVar('uid') != $tmpstory->uid() && !is_admin_group()) {
				redirect_header(XOOPS_URL . '/modules/news/index.php', 3, _NOPERM);
				exit();
			}
		} else { // Users can't edit their articles
			if (!is_admin_group()) {
				redirect_header(XOOPS_URL . '/modules/news/index.php', 3, _NOPERM);
				exit();
			}
		}
	}

	if ($approveprivilege && $_GET['op'] == 'edit') {
		$op = 'edit';
		$storyid = intval($_GET['storyid']);
	} elseif ($approveprivilege && $_GET['op'] == 'delete') {
		$op = 'delete';
		$storyid = intval($_GET['storyid']);
	} else {
		if (getmoduleoption('authoredit') && is_object($xoopsUser) && isset($_GET['storyid']) && ($_GET['op'] == 'edit' || $_POST['op'] == 'preview' || $_POST['op'] == 'post')) {
			$storyid = 0;
			$storyid = isset($_GET['storyid']) ? intval($_GET['storyid']) : intval($_POST['storyid']);
			if (!empty($storyid)) {
				$tmpstory = new NewsStory($storyid);
				if ($tmpstory->uid() == $xoopsUser->getVar('uid')) {
					$op = isset($_GET['op']) ? $_GET['op'] : $_POST['post'];
					unset($tmpstory);
					$approveprivilege = 1;
				} else {
					unset($tmpstory);
					if (!is_admin_group()) {
						redirect_header(XOOPS_URL . "/modules/news/index.php", 3, _NOPERM);
						exit();
					} else {
						$approveprivilege = 1;
					}
				}
			}
		} else {
			if (!is_admin_group()) {
				unset($tmpstory);
				redirect_header(XOOPS_URL . "/modules/news/index.php", 3, _NOPERM);
				exit();
			} else {
				$approveprivilege = 1;
			}
		}
	}
}
$xoopsOption['template_main'] = 'news_submit.html'; // by makinosuke @ 2009.1.5
$xoopsTpl->assign('action', $op); // by makinosuke @ 2009.1.5
$xoopsTpl->assign('xoops_module_header', '<link href="style.css" media="screen,tv,print" type="text/css" rel="stylesheet" /><script src="js/jquery-1.2.6.min.js" type="text/javascript"></script><script src="js/markitup/jquery.markitup.pack.js" type="text/javascript"></script><script src="js/markitup/sets/bbcode/set.js" type="text/javascript"></script><link href="js/markitup/skins/simple/style.css" type="text/css" rel="stylesheet" /><link href="js/markitup/sets/bbcode/style.css" type="text/css" rel="stylesheet" />'); // by makinosuke @ 2009.1.10
switch ($op) {
	case 'edit':
		$xoopsTpl->assign('lang_editarticle', _AM_EDITARTICLE); // by makinosuke @ 2009.1.5
		$xoopsTpl->assign('lang_pagetitle', _AM_EDITARTICLE); // by makinosuke @ 2009.1.10

		if (!$approveprivilege) {
			redirect_header(XOOPS_URL . '/modules/news/index.php', 0, _NOPERM);
			exit();
			break;
		}
		//if($storyid==0 && isset($_POST['storyid'])) {
		//	$storyid=intval($_POST['storyid']);
		//}
		$story = new NewsStory($storyid);
		if (!$gperm_handler->checkRight("news_view", $story->topicid(), $groups, $module_id)) {
			redirect_header(XOOPS_URL . '/modules/news/index.php', 0, _NOPERM);
			exit();
			break;
		}
//        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">"; // by makinosuke @ 2009.1.5
//        echo "<h4>" . _AM_EDITARTICLE . "</h4>"; // by makinosuke @ 2009.1.5
		$title = $story->title("Edit");
		$hometext = $story->hometext("Edit");
		$bodytext = $story->bodytext("Edit");
		$nohtml = $story->nohtml();
		$nosmiley = $story->nosmiley();
		$description = $story->description();
		$keywords = $story->keywords();
		$ihome = $story->ihome();
		$newsauthor = $story->uid();
		$topicid = $story->topicid();
		$notifypub = $story->notifypub();
		$approve = 0;
		$published = $story->published();
		if (isset($published) && $published > 0) {
			$approve = 1;
		}
		if ($story->published() != 0) {
			$published = $story->published();
		}
		if ($story->expired() != 0) {
			$expired = $story->expired();
		} else {
			$expired = 0;
		}
		$type = $story->type();
		$topicdisplay = $story->topicdisplay();
		$topicalign = $story->topicalign(FALSE);
		include_once XOOPS_ROOT_PATH . "/modules/news/include/storyform.inc.php";
//        echo"</td></tr></table>"; // by makinosuke @ 2009.1.5
		break;

	case 'preview':
		$xoopsTpl->assign('lang_pagetitle', _AM_EDITARTICLE); // by makinosuke @ 2009.1.10
		$xoopsTpl->assign('lang_pagesubtitle', _AM_PREVIEW); // by makinosuke @ 2009.1.10
		$topic_id = intval($_POST['topic_id']);
		$xt = new NewsTopic($topic_id);
		if (isset($_GET['storyid'])) {
			$storyid = intval($_GET['storyid']);
		} else {
			if (isset($_POST['storyid'])) {
				$storyid = intval($_POST['storyid']);
			} else {
				$storyid = 0;
			}
		}

		if (!empty($storyid)) {
			$story = new NewsStory($storyid);
			$published = $story->published();
			$expired = $story->expired();
		} else {
			$story = new NewsStory();
			$published = isset($_POST['publish_date']) ? $_POST['publish_date'] : 0;
			if (!empty($published) && isset($_POST['autodate']) && intval($_POST['autodate'] == 1)) {
				$published = strtotime($published['date']) + $published['time'];
			} else {
				$published = 0;
			}
			$expired = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : 0;
			if (!empty($expired) && isset($_POST['autoexpdate']) && intval($_POST['autoexpdate'] == 1)) {
				$expired = strtotime($expired['date']) + $expired['time'];
			} else {
				$expired = 0;
			}
		}
		$topicid = $topic_id;
		if (isset($_POST['topicdisplay'])) {
			$topicdisplay = intval($_POST['topicdisplay']);
		} else {
			$topicdisplay = 1;
		}

		$approve = isset($_POST['approve']) ? intval($_POST['approve']) : 0;
		$topicalign = 'R';
		if (isset($_POST['topicalign'])) {
			$topicalign = $_POST['topicalign'];
		}
		$story->setTitle($_POST['title']);
		$story->setHometext($_POST['hometext']);
		if ($approveprivilege) {
			$story->setTopicdisplay($topicdisplay);
			$story->setTopicalign($topicalign);
			$story->setBodytext($_POST['bodytext']);
			if (getmoduleoption('metadata')) {
				$story->Setkeywords($_POST['keywords']);
				$story->Setdescription($_POST['description']);
				$story->setIhome(intval($_POST['ihome']));
			}
		} else {
			$noname = isset($_POST['noname']) ? intval($_POST['noname']) : 0;
		}

		if ($approveprivilege || (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid()))) {
			if (isset($_POST['author'])) {
				$story->setUid(intval($_POST['author']));
			}
		}

		$notifypub = isset($_POST['notifypub']) ? intval($_POST['notifypub']) : 0;

		$nosmiley = isset($_POST['nosmiley']) ? intval($_POST['nosmiley']) : 0;
		if (isset($nosmiley) && ($nosmiley == 0 || $nosmiley == 1)) {
			$story->setNosmiley($nosmiley);
		} else {
			$nosmiley = 0;
		}
		if ($approveprivilege) {
			$nohtml = isset($_POST['nohtml']) ? intval($_POST['nohtml']) : 0;
			$story->setNohtml($nohtml);
			if (!isset($_POST['approve'])) {
				$approve = 0;
			}
		} else {
			$story->setNohtml = 1;
		}

		$title = $story->title("InForm");
		$hometext = $story->hometext("InForm");
		if ($approveprivilege) {
			$bodytext = $story->bodytext("InForm");
			$ihome = $story->ihome();
			$description = $story->description('E');
			$keywords = $story->keywords('E');
		}

		//Display post preview
		$newsauthor = $story->uid();
		$p_title = $story->title("Preview");
		$p_hometext = $story->hometext("Preview");
		if ($approveprivilege) {
			$p_bodytext = $story->bodytext("Preview");
//	    	$p_hometext .= '<br /><br />'.$p_bodytext;//by makinosuke @ 2009.1.10
		}
		$topicalign2 = isset($story->topicalign) ? 'align="' . $story->topicalign() . '"' : "";
		$p_hometext = (($xt->topic_imgurl() != '') && $topicdisplay) ? '<img src="images/topics/' . $xt->topic_imgurl() . '" ' . $topicalign2 . ' alt="" />' . $p_hometext : $p_hometext;
//		themecenterposts($p_title, $p_hometext);//by makinosuke @ 2009.1.9
		$xoopsTpl->assign('preview_title', $p_title); // by makinosuke @ 2009.1.10
		$xoopsTpl->assign('preview_hometext', $p_hometext); // by makinosuke @ 2009.1.10
		$xoopsTpl->assign('preview_bodytext', $p_bodytext); // by makinosuke @ 2009.1.10

		//Display post edit form
		$returnside = intval($_POST['returnside']);
		include_once XOOPS_ROOT_PATH . '/modules/news/include/storyform.inc.php';
		break;

	case 'post':
		$nohtml_db = isset($_POST['nohtml']) ? $_POST['nohtml'] : 1;
		if (is_object($xoopsUser)) {
			$uid = $xoopsUser->getVar('uid');
			if ($approveprivilege) {
				$nohtml_db = empty($_POST['nohtml']) ? 0 : 1;
			}
			if (isset($_POST['author']) && ($approveprivilege || $xoopsUser->isAdmin($xoopsModule->mid()))) {
				$uid = intval($_POST['author']);
			}
		} else {
			$uid = 0;
		}

		if (isset($_GET['storyid'])) {
			$storyid = intval($_GET['storyid']);
		} else {
			if (isset($_POST['storyid'])) {
				$storyid = intval($_POST['storyid']);
			} else {
				$storyid = 0;
			}
		}

		if (empty($storyid)) {
			$story = new NewsStory();
		} else {
			$story = new NewsStory($storyid);
		}
		$story->setUid($uid);
		$story->setTitle($_POST['title']);
		$story->setHometext($_POST['hometext']);
		$story->setTopicId(intval($_POST['topic_id']));
		$story->setHostname(xoops_getenv('REMOTE_ADDR'));
		$story->setNohtml($nohtml_db);
		$nosmiley = isset($_POST['nosmiley']) ? intval($_POST['nosmiley']) : 0;
		$story->setNosmiley($nosmiley);
		$notifypub = isset($_POST['notifypub']) ? intval($_POST['notifypub']) : 0;
		$story->setNotifyPub($notifypub);
		$story->setType($_POST['type']);

		if (!empty($_POST['autodate']) && $approveprivilege) {
			$publish_date = $_POST['publish_date'];
			$pubdate = strtotime($publish_date['date']) + $publish_date['time'];
			//$offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
			//$pubdate = $pubdate - ( $offset * 3600 );
			$story->setPublished($pubdate);
		}
		if (!empty($_POST['autoexpdate']) && $approveprivilege) {
			$expiry_date = $_POST['expiry_date'];
			$expiry_date = strtotime($expiry_date['date']) + $expiry_date['time'];
			$offset = $xoopsUser->timezone() - $xoopsConfig['server_TZ'];
			$expiry_date = $expiry_date - ($offset * 3600);
			$story->setExpired($expiry_date);
		} else {
			$story->setExpired(0);
		}

		if ($approveprivilege) {
			if (getmoduleoption('metadata')) {
				$story->Setdescription($_POST['description']);
				$story->Setkeywords($_POST['keywords']);
			}
			$story->setTopicdisplay($_POST['topicdisplay']); // Display Topic Image ? (Yes or No)
			$story->setTopicalign($_POST['topicalign']); // Topic Align, 'Right' or 'Left'
			$story->setIhome($_POST['ihome']); // Publish in home ? (Yes or No)
			if (isset($_POST['bodytext'])) {
				$story->setBodytext($_POST['bodytext']);
			} else {
				$story->setBodytext(' ');
			}
			$approve = isset($_POST['approve']) ? intval($_POST['approve']) : 0;

			if (!$story->published() && $approve) {
				$story->setPublished(time());
			}
			if (!$story->expired()) {
				$story->setExpired(0);
			}

			if (!$approve) {
				$story->setPublished(0);
			}
		} elseif ($xoopsModuleConfig['autoapprove'] == 1 && !$approveprivilege) {
			if (empty($storyid)) {
				$approve = 1;
			} else {
				$approve = isset($_POST['approve']) ? intval($_POST['approve']) : 0;
			}
			if ($approve) {
				$story->setPublished(time());
			} else {
				$story->setPublished(0);
			}
			$story->setExpired(0);
			$story->setTopicalign('R');
		} else {
			$approve = 0;
		}
		$story->setApproved($approve);

		if ($approve) {
			updateCache();
		}

		// Increment author's posts count (only if it's a new article)
		// First case, it's not an anonyous, the story is approved and it's a new story
		if ($uid && $approve && empty($storyid)) {
			$tmpuser = new xoopsUser($uid);
			$member_handler =& xoops_gethandler('member');
			$member_handler->updateUserByField($tmpuser, 'posts', $tmpuser->getVar('posts') + 1);
		}

		// Second case, it's not an anonymous, the story is NOT approved and it's NOT a new story (typical when someone is approving a submited story)
		if (is_object($xoopsUser) && $approve && !empty($storyid)) {
			$storytemp = new NewsStory($storyid);
			if (!$storytemp->published() && $storytemp->uid() > 0) { // the article has been submited but not approved
				$tmpuser = new xoopsUser($storytemp->uid());
				$member_handler =& xoops_gethandler('member');
				$member_handler->updateUserByField($tmpuser, 'posts', $tmpuser->getVar('posts') + 1);
			}
			unset($storytemp);
		}

		$result = $story->store();
		if ($result) {
			// Notification
			$notification_handler =& xoops_gethandler('notification');
			$tags = array();
			$xt = new NewsTopic($story->topicid());
			$tags['TOPIC_NAME'] = $xt->topic_title('S');
			$tags['STORY_NAME'] = $story->title();
			$tags['STORY_HOME'] = $story->hometext("InForm");
			$tags['STORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/article.php?storyid=' . $story->storyid();
			// If notify checkbox is set, add subscription for approve
			if ($notifypub && $approve) {
				include_once XOOPS_ROOT_PATH . '/include/notification_constants.php';
				$notification_handler->subscribe('story', $story->storyid(), 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE, $xoopsModule->getVar('mid'), $story->uid());
			}

			if ($approve == 1) {
				$notification_handler->triggerEvent('global', 0, 'new_story', $tags);
				$notification_handler->triggerEvent('topic', $story->topicid(), 'new_story', $tags);
				$notification_handler->triggerEvent('story', $story->storyid(), 'approve', $tags);
			} else {
				$tags['WAITINGSTORIES_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=newarticle';
				$notification_handler->triggerEvent('global', 0, 'story_submit', $tags);
			}

			$allowupload = FALSE;
			switch ($xoopsModuleConfig['uploadgroups']) {
				case 1: //Submitters and Approvers
					$allowupload = TRUE;
					break;
				case 2: //Approvers only
					$allowupload = $approveprivilege ? TRUE : FALSE;
					break;
				case 3: //Upload Disabled
					$allowupload = FALSE;
					break;
			}

			if ($allowupload) {
				// Manage upload(s)
				if (isset($_POST['delupload']) && count($_POST['delupload']) > 0) {
					foreach ($_POST['delupload'] as $onefile) {
						$sfiles = new sFiles($onefile);
						$sfiles->delete();
					}
				}

				if (isset($_POST['xoops_upload_file'])) {
					$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
					$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
					if (xoops_trim($fldname != '')) {
						$sfiles = new sFiles();
						$destname = $sfiles->createUploadName(UPLOADS, $fldname);
						/**
						 * You can attach files to your news, actually : Web pictures (png, gif, jpeg), zip, pdf, gtar, tar, pdf
						 */
						// comment out by yoshis : there is in fileup.ini.php
						//$permittedtypes=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png' ,'application/x-zip-compressed','application/zip', 'application/pdf', 'application/x-gtar', 'application/x-tar');
						//$permittedtypes = explode("|",$xoopsModuleConfig['uploadtypes']);
						$uploader = new XoopsMediaUploader(UPLOADS, $permittedtypes, $xoopsModuleConfig['maxuploadsize']);
						$uploader->setTargetFileName($destname);
						if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
							if ($uploader->upload()) {
								$sfiles->setFileRealName($uploader->getMediaName());
								$sfiles->setStoryid($story->storyid());
								$sfiles->setMimetype($sfiles->giveMimetype(UPLOADS . '/' . $uploader->getMediaName()));
								$sfiles->setSize($_FILES[$_POST['xoops_upload_file'][0]]['size']); // by yoshis
								$sfiles->setDownloadname($destname);
								if (!$sfiles->store()) {
									echo _AM_UPLOAD_DBERROR_SAVE;
								}
							} else {
								echo _AM_UPLOAD_ERROR . ' ' . $uploader->getErrors() . $_FILES[$_POST['xoops_upload_file'][0]]['type'];
							}
						} else {
							echo $uploader->getErrors();
						}
					}
				}
			}
			// by yoshis
			if ($_FILES[$_POST['xoops_upload_file'][0]]['tmp_name']) {
				$hometext = news_fileup(
					$_POST['hometext'],
					$sfiles->getDownloadname(),
					$sfiles->getFileRealName(),
					$sfiles->getMimetype(),
					$sfiles->getSize()
				);
				$story->setHometext($hometext);
			} else {
				$story->setHometext($_POST['hometext']);
			}
			$result = $story->store();
			// Add end
		} else {
			echo _ERRORS;
		}
		$returnside = intval($_POST['returnside']);
		if($approve!=0){
			$redirect_message = _NW_THANKS_APPROVE;
		}else{
			$redirect_message = _NW_THANKS;
		}
		if (!$returnside) {
			redirect_header(XOOPS_URL . "/modules/news/index.php", 3, $redirect_message );
			exit();
		} else {
			redirect_header(XOOPS_URL . "/modules/news/admin/index.php?op=newarticle", 2, $redirect_message );
			exit();
		}
		break;

	case 'form':
		$xoopsTpl->assign('lang_pagetitle', _AM_POSTNEWARTICLE); // by makinosuke @ 2009.1.10
		$xt = new NewsTopic();
		$title = '';
		$hometext = '';
		$noname = 0;
		$nohtml = 0;
		$nosmiley = 0;
		$notifypub = 1;
		$topicid = 0;
		if ($approveprivilege) {
			$description = '';
			$keywords = '';
			$topicdisplay = 0;
			$topicalign = 'R';
			$ihome = 0;
			$bodytext = '';
			$approve = 0;
			$autodate = '';
			$expired = 0;
			$published = 0;
		}
		if ($xoopsModuleConfig['autoapprove'] == 1) {
			$approve = 1;
		}
		include_once XOOPS_ROOT_PATH . '/modules/news/include/storyform.inc.php';
		break;
}
include_once XOOPS_ROOT_PATH . '/footer.php';
?>
