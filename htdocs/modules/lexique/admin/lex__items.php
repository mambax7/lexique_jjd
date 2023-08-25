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
$itemId = Request::getInt('item_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);
$listId = Request::getInt('list_id');

switch ($op) {
    case 'list':
    default:
        $listArr = $lex__listsHandler->getList();   
        if ($listId == 0) $listId = array_key_first( $listArr);
        
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__items.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__items.php'));
        
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LIST, 'lex__lists.php?op=new');        
        $adminObject->addItemButton(sprintf(\_AM_LEXIQUE_EDIT_LEX__LIST, $listArr[$listId])  , "lex__lists.php?op=edit&list_id={$listId}");        
        $adminObject->addItemButton(sprintf(\_AM_LEXIQUE_DELETE_LEX__LIST, $listArr[$listId])  , "lex__lists.php?op=delete&list_id={$listId}");
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__ITEM, "lex__items.php?op=new&list_id={$listId}");

        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        
         //--------------- Criteres de Selection ------------------------------
        $inpList = new XoopsFormSelect('', 'list_id', $listId);
        $inpList->addOptionArray($listArr);
        $inpList->setExtra('onchange="document.select_filter.submit();"');        
        $GLOBALS['xoopsTpl']->assign('selet_list_id', $inpList->render());
        
        // cherches les items selon les criteres
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('item_list_id',$listId, "="));

//echo "===> listId = {$listId}<hr>";
        $lex__itemsCount = $lex__itemsHandler->getCountLex__items($criteria);
        $lex__itemsAll = $lex__itemsHandler->getAllLex__items($criteria, $start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__items_count', $lex__itemsCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        // Table view lex__items
        if ($lex__itemsCount > 0) {
            foreach (\array_keys($lex__itemsAll) as $i) {
                $lex__item = $lex__itemsAll[$i]->getValuesLex__items();
                $GLOBALS['xoopsTpl']->append('lex__items_list', $lex__item);
                unset($lex__item);
            }
            // Display Navigation
            if ($lex__itemsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__itemsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__ITEMS);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__items.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__items.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__ITEMS, 'lex__items.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__itemsObj = $lex__itemsHandler->create();
        $lex__itemsObj->setVar('item_list_id', $listId);
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__items.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__items.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__ITEMS, 'lex__items.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__ITEM, 'lex__items.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $itemIdSource = Request::getInt('item_id_source');
        // Get Form
        $lex__itemsObjSource = $lex__itemsHandler->get($itemIdSource);
        $lex__itemsObj = $lex__itemsObjSource->xoopsClone();
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
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
        // Set Vars
        $lex__itemsObj->setVar('item_list_id', Request::getInt('item_list_id'));
        $lex__itemsObj->setVar('item_name', Request::getString('item_name'));
        // Insert Data
        if ($lex__itemsHandler->insert($lex__itemsObj)) {
                $listId = $lex__itemsObj->getVar('item_list_id');
                \redirect_header("lex__items.php?op=list&list_id={$listId}&start={$start}&limit={$limit}" , 2, \_AM_LEXIQUE_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__itemsObj->getHtmlErrors());
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__items.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__items.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__ITEM, 'lex__items.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__ITEMS, 'lex__items.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__itemsObj = $lex__itemsHandler->get($itemId);
        $lex__itemsObj->start = $start;
        $lex__itemsObj->limit = $limit;
        $form = $lex__itemsObj->getFormLex__items();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__items.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__items.php'));
        $lex__itemsObj = $lex__itemsHandler->get($itemId);
        $listId = $lex__itemsObj->getVar('item_list_id');
        
        $_xyz_ = $lex__itemsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header("lex__items.php?op=list&list_id={$listId}", 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
                \redirect_header("lex__items.php?op=list&list_id={$listId}" , 2, \_AM_LEXIQUE_FORM_OK);
            }
            if ($lex__itemsHandler->delete($lex__itemsObj)) {
                \redirect_header("lex__items.php?op=list&list_id={$listId}", 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__itemsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'item_id' => $itemId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__itemsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
