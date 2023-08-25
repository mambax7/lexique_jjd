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
// Get all request values
$op     = Request::getCmd('op', 'list');
$listId = Request::getInt('list_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__lists.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__lists.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LIST, 'lex__lists.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__listsCount = $lex__listsHandler->getCountLex__lists();
        $lex__listsAll = $lex__listsHandler->getAllLex__lists($start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__lists_count', $lex__listsCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        // Table view lex__lists
        if ($lex__listsCount > 0) {
            foreach (\array_keys($lex__listsAll) as $i) {
                $lex__list = $lex__listsAll[$i]->getValuesLex__lists();
                $GLOBALS['xoopsTpl']->append('lex__lists_list', $lex__list);
                unset($lex__list);
            }
            // Display Navigation
            if ($lex__listsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__listsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__LISTS);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__lists.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__lists.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LISTS, 'lex__lists.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__listsObj = $lex__listsHandler->create();
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__lists.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__lists.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LISTS, 'lex__lists.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LIST, 'lex__lists.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $listIdSource = Request::getInt('list_id_source');
        // Get Form
        $lex__listsObjSource = $lex__listsHandler->get($listIdSource);
        $lex__listsObj = $lex__listsObjSource->xoopsClone();
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
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
        // Set Vars
        $lex__listsObj->setVar('list_name', Request::getString('list_name'));
        $lex__listsObj->setVar('list_description', Request::getText('list_description'));
        // Insert Data
        if ($lex__listsHandler->insert($lex__listsObj)) {
                $newListId = $lex__listsObj->getNewInsertedIdLex__lists();
                //\redirect_header('lex__lists.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
                \redirect_header("lex__items.php?op=list&list_id={$newListId}&amp;start={$start}&amp;limit={$limit}", 2, \_AM_LEXIQUE_FORM_OK);

        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__listsObj->getHtmlErrors());
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__lists.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__lists.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LIST, 'lex__lists.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LISTS, 'lex__lists.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__listsObj = $lex__listsHandler->get($listId);
        $lex__listsObj->start = $start;
        $lex__listsObj->limit = $limit;
        $form = $lex__listsObj->getFormLex__lists();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__lists.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__lists.php'));
        $lex__listsObj = $lex__listsHandler->get($listId);
        $_xyz_ = $lex__listsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                //\redirect_header('lex__lists.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
                \redirect_header('lex__items.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__listsHandler->delete($lex__listsObj)) {
                \redirect_header('lex__items.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__listsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'list_id' => $listId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__listsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
