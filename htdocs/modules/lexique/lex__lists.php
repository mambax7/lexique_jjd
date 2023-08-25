<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Lexique module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:jjdelalandre@orange.fr - Website:https://oritheque.fr
 */

use Xmf\Request;
use XoopsModules\Lexique;
use XoopsModules\Lexique\Constants;
use XoopsModules\Lexique\Common;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__lists.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op     = Request::getCmd('op', 'list');
$listId = Request::getInt('list_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_INDEX, 'link' => 'index.php'];
// Permissions
$GLOBALS['xoopsTpl']->assign('showItem', $listId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LISTS_LIST];
        $crLex__lists = new \CriteriaCompo();
        if ($listId > 0) {
            $crLex__lists->add(new \Criteria('list_id', $listId));
        }
        $lex__listsCount = $lex__listsHandler->getCount($crLex__lists);
        $GLOBALS['xoopsTpl']->assign('lex__listsCount', $lex__listsCount);
        if (0 === $listId) {
            $crLex__lists->setStart($start);
            $crLex__lists->setLimit($limit);
        }
        $lex__listsAll = $lex__listsHandler->getAll($crLex__lists);
        if ($lex__listsCount > 0) {
            $lex__lists = [];
            $ = '';
            // Get All Lex__lists
            foreach (\array_keys($lex__listsAll) as $i) {
                $lex__lists[$i] = $lex__listsAll[$i]->getValuesLex__lists();
                $_xyz_ = $lex__listsAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__lists', $lex__lists);
            unset($lex__lists);
            // Display Navigation
            if ($lex__listsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__listsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($ . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__lists.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($listId > 0) {
            $lex__listsObj = $lex__listsHandler->get($listId);
        } else {
            $lex__listsObj = $lex__listsHandler->create();
        }
        $lex__listsObj->setVar('list_name', Request::getString('list_name'));
        $lex__listsObj->setVar('list_description', Request::getText('list_description'));
        // Insert Data
        if ($lex__listsHandler->insert($lex__listsObj)) {
            // redirect after insert
                \redirect_header('lex__lists.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__listsObj->getHtmlErrors());
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LIST_ADD];
        // Form Create
        $lex__listsObj = $lex__listsHandler->create();
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LIST_EDIT];
        // Check params
        if (0 == $listId) {
            \redirect_header('lex__lists.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__listsObj = $lex__listsHandler->get($listId);
        $lex__listsObj->start = $start;
        $lex__listsObj->limit = $limit;
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LIST_CLONE];
        // Request source
        $listIdSource = Request::getInt('list_id_source');
        // Check params
        if (0 == $listIdSource) {
            \redirect_header('lex__lists.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__listsObjSource = $lex__listsHandler->get($listIdSource);
        $lex__listsObj = $lex__listsObjSource->xoopsClone();
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LIST_DELETE];
        // Check params
        if (0 == $listId) {
            \redirect_header('lex__lists.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__listsObj = $lex__listsHandler->get($listId);
        $_xyz_ = $lex__listsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__lists.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__listsHandler->delete($lex__listsObj)) {
                \redirect_header('lex__lists.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__listsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'list_id' => $listId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__listsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_LISTS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__lists.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
