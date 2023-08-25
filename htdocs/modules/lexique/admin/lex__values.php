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
$op    = Request::getCmd('op', 'list');
$valId = Request::getInt('val_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__values.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__values.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__VALUE, 'lex__values.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__valuesCount = $lex__valuesHandler->getCountLex__values();
        $lex__valuesAll = $lex__valuesHandler->getAllLex__values(null, $start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__values_count', $lex__valuesCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        // Table view lex__values
        if ($lex__valuesCount > 0) {
            foreach (\array_keys($lex__valuesAll) as $i) {
                $lex__value = $lex__valuesAll[$i]->getValuesLex__values();
                $GLOBALS['xoopsTpl']->append('lex__values_list', $lex__value);
                unset($lex__value);
            }
            // Display Navigation
            if ($lex__valuesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__valuesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__VALUES);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__values.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__values.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__VALUES, 'lex__values.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__valuesObj = $lex__valuesHandler->create();
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__values.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__values.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__VALUES, 'lex__values.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__VALUE, 'lex__values.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $valIdSource = Request::getInt('val_id_source');
        // Get Form
        $lex__valuesObjSource = $lex__valuesHandler->get($valIdSource);
        $lex__valuesObj = $lex__valuesObjSource->xoopsClone();
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__values.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($valId > 0) {
            $lex__valuesObj = $lex__valuesHandler->get($valId);
        } else {
            $lex__valuesObj = $lex__valuesHandler->create();
        }
        // Set Vars
        $lex__valuesObj->setVar('val_lex_id', Request::getInt('val_lex_id'));
        $lex__valuesObj->setVar('val_ppt_id', Request::getInt('val_ppt_id'));
        $lex__valuesObj->setVar('val_term_id', Request::getInt('val_term_id'));
        $lex__valuesObj->setVar('val_value', Request::getText('val_value'));
        $lex__valuesObj->setVar('val_link', Request::getString('val_link'));
        $lex__valuesObj->setVar('val_attributs', Request::getString('val_attributs'));
        // Insert Data
        if ($lex__valuesHandler->insert($lex__valuesObj)) {
                \redirect_header('lex__values.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__valuesObj->getHtmlErrors());
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__values.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__values.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__VALUE, 'lex__values.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__VALUES, 'lex__values.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__valuesObj = $lex__valuesHandler->get($valId);
        $lex__valuesObj->start = $start;
        $lex__valuesObj->limit = $limit;
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__values.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__values.php'));
        $lex__valuesObj = $lex__valuesHandler->get($valId);
        $_xyz_ = $lex__valuesObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__values.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__valuesHandler->delete($lex__valuesObj)) {
                \redirect_header('lex__values.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__valuesObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'val_id' => $valId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__valuesObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
