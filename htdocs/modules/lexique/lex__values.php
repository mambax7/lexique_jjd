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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__values.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$valId = Request::getInt('val_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
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
$GLOBALS['xoopsTpl']->assign('showItem', $valId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_VALUES_LIST];
        $crLex__values = new \CriteriaCompo();
        if ($valId > 0) {
            $crLex__values->add(new \Criteria('val_id', $valId));
        }
        $lex__valuesCount = $lex__valuesHandler->getCount($crLex__values);
        $GLOBALS['xoopsTpl']->assign('lex__valuesCount', $lex__valuesCount);
        if (0 === $valId) {
            $crLex__values->setStart($start);
            $crLex__values->setLimit($limit);
        }
        $lex__valuesAll = $lex__valuesHandler->getAll($crLex__values);
        if ($lex__valuesCount > 0) {
            $lex__values = [];
            $ = '';
            // Get All Lex__values
            foreach (\array_keys($lex__valuesAll) as $i) {
                $lex__values[$i] = $lex__valuesAll[$i]->getValuesLex__values();
                $_xyz_ = $lex__valuesAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__values', $lex__values);
            unset($lex__values);
            // Display Navigation
            if ($lex__valuesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__valuesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
            \redirect_header('lex__values.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($valId > 0) {
            $lex__valuesObj = $lex__valuesHandler->get($valId);
        } else {
            $lex__valuesObj = $lex__valuesHandler->create();
        }
        $lex__valuesObj->setVar('val_lex_id', Request::getInt('val_lex_id'));
        $lex__valuesObj->setVar('val_ppt_id', Request::getInt('val_ppt_id'));
        $lex__valuesObj->setVar('val_term_id', Request::getInt('val_term_id'));
        $lex__valuesObj->setVar('val_value', Request::getText('val_value'));
        $lex__valuesObj->setVar('val_link', Request::getString('val_link'));
        $lex__valuesObj->setVar('val_attributs', Request::getString('val_attributs'));
        // Insert Data
        if ($lex__valuesHandler->insert($lex__valuesObj)) {
            // redirect after insert
                \redirect_header('lex__values.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__valuesObj->getHtmlErrors());
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_VALUE_ADD];
        // Form Create
        $lex__valuesObj = $lex__valuesHandler->create();
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_VALUE_EDIT];
        // Check params
        if (0 == $valId) {
            \redirect_header('lex__values.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__valuesObj = $lex__valuesHandler->get($valId);
        $lex__valuesObj->start = $start;
        $lex__valuesObj->limit = $limit;
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_VALUE_CLONE];
        // Request source
        $valIdSource = Request::getInt('val_id_source');
        // Check params
        if (0 == $valIdSource) {
            \redirect_header('lex__values.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__valuesObjSource = $lex__valuesHandler->get($valIdSource);
        $lex__valuesObj = $lex__valuesObjSource->xoopsClone();
        $form = $lex__valuesObj->getFormLex__values();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_VALUE_DELETE];
        // Check params
        if (0 == $valId) {
            \redirect_header('lex__values.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__valuesObj = $lex__valuesHandler->get($valId);
        $_xyz_ = $lex__valuesObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__values.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__valuesHandler->delete($lex__valuesObj)) {
                \redirect_header('lex__values.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__valuesObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'val_id' => $valId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__valuesObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_VALUES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__values.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
