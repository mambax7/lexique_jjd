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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__items.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op     = Request::getCmd('op', 'list');
$itemId = Request::getInt('item_id');
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
$GLOBALS['xoopsTpl']->assign('showItem', $itemId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_ITEMS_LIST];
        $crLex__items = new \CriteriaCompo();
        if ($itemId > 0) {
            $crLex__items->add(new \Criteria('item_id', $itemId));
        }
        $lex__itemsCount = $lex__itemsHandler->getCount($crLex__items);
        $GLOBALS['xoopsTpl']->assign('lex__itemsCount', $lex__itemsCount);
        if (0 === $itemId) {
            $crLex__items->setStart($start);
            $crLex__items->setLimit($limit);
        }
        $lex__itemsAll = $lex__itemsHandler->getAll($crLex__items);
        if ($lex__itemsCount > 0) {
            $lex__items = [];
            $ = '';
            // Get All Lex__items
            foreach (\array_keys($lex__itemsAll) as $i) {
                $lex__items[$i] = $lex__itemsAll[$i]->getValuesLex__items();
                $_xyz_ = $lex__itemsAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__items', $lex__items);
            unset($lex__items);
            // Display Navigation
            if ($lex__itemsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__itemsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
            \redirect_header('lex__items.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($itemId > 0) {
            $lex__itemsObj = $lex__itemsHandler->get($itemId);
        } else {
            $lex__itemsObj = $lex__itemsHandler->create();
        }
        $lex__itemsObj->setVar('item_list_id', Request::getInt('item_list_id'));
        $lex__itemsObj->setVar('item_name', Request::getString('item_name'));
        // Insert Data
        if ($lex__itemsHandler->insert($lex__itemsObj)) {
            // redirect after insert
                \redirect_header('lex__items.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__itemsObj->getHtmlErrors());
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_ITEM_ADD];
        // Form Create
        $lex__itemsObj = $lex__itemsHandler->create();
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_ITEM_EDIT];
        // Check params
        if (0 == $itemId) {
            \redirect_header('lex__items.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__itemsObj = $lex__itemsHandler->get($itemId);
        $lex__itemsObj->start = $start;
        $lex__itemsObj->limit = $limit;
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_ITEM_CLONE];
        // Request source
        $itemIdSource = Request::getInt('item_id_source');
        // Check params
        if (0 == $itemIdSource) {
            \redirect_header('lex__items.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__itemsObjSource = $lex__itemsHandler->get($itemIdSource);
        $lex__itemsObj = $lex__itemsObjSource->xoopsClone();
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_ITEM_DELETE];
        // Check params
        if (0 == $itemId) {
            \redirect_header('lex__items.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__itemsObj = $lex__itemsHandler->get($itemId);
        $_xyz_ = $lex__itemsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__items.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__itemsHandler->delete($lex__itemsObj)) {
                \redirect_header('lex__items.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__itemsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'item_id' => $itemId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__itemsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_ITEMS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__items.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
