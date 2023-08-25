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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__propertys.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$pptId = Request::getInt('ppt_id');
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
$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $pptId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PROPERTYS_LIST];
        $crLex__propertys = new \CriteriaCompo();
        if ($pptId > 0) {
            $crLex__propertys->add(new \Criteria('ppt_id', $pptId));
        }
        $lex__propertysCount = $lex__propertysHandler->getCount($crLex__propertys);
        $GLOBALS['xoopsTpl']->assign('lex__propertysCount', $lex__propertysCount);
        if (0 === $pptId) {
            $crLex__propertys->setStart($start);
            $crLex__propertys->setLimit($limit);
        }
        $lex__propertysAll = $lex__propertysHandler->getAll($crLex__propertys);
        if ($lex__propertysCount > 0) {
            $lex__propertys = [];
            $ = '';
            // Get All Lex__propertys
            foreach (\array_keys($lex__propertysAll) as $i) {
                $lex__propertys[$i] = $lex__propertysAll[$i]->getValuesLex__propertys();
                $_xyz_ = $lex__propertysAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__propertys', $lex__propertys);
            unset($lex__propertys);
            // Display Navigation
            if ($lex__propertysCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__propertysCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
            \redirect_header('lex__propertys.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__propertys.php?op=list', 3, \_NOPERM);
        }
        if ($pptId > 0) {
            $lex__propertysObj = $lex__propertysHandler->get($pptId);
        } else {
            $lex__propertysObj = $lex__propertysHandler->create();
        }
        $lex__propertysObj->setVar('ppt_list_id', Request::getInt('ppt_list_id'));
        $lex__propertysObj->setVar('ppt_dtype_id', Request::getInt('ppt_dtype_id'));
        $lex__propertysObj->setVar('ppt_name', Request::getString('ppt_name'));
        $lex__propertysObj->setVar('ppt_active', Request::getInt('ppt_active'));
        $lex__propertysObj->setVar('ppt_weight', Request::getInt('ppt_weight'));
        $lex__propertysObj->setVar('ppt_css', Request::getText('ppt_css'));
        $lex__propertysObj->setVar('ppt_is_criteria', Request::getInt('ppt_is_criteria'));
        $lex__propertysObj->setVar('ppt_attributs', Request::getInt('ppt_attributs'));
        // Insert Data
        if ($lex__propertysHandler->insert($lex__propertysObj)) {
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_view_lex__propertys', $newPptId);
            if (isset($_POST['groups_view_lex__propertys'])) {
                foreach ($_POST['groups_view_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_view_lex__propertys', $newPptId, $onegroupId, $mid);
                }
            }
            // Permission to submit_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_submit_lex__propertys', $newPptId);
            if (isset($_POST['groups_submit_lex__propertys'])) {
                foreach ($_POST['groups_submit_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_submit_lex__propertys', $newPptId, $onegroupId, $mid);
                }
            }
            // Permission to approve_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_approve_lex__propertys', $newPptId);
            if (isset($_POST['groups_approve_lex__propertys'])) {
                foreach ($_POST['groups_approve_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_approve_lex__propertys', $newPptId, $onegroupId, $mid);
                }
            }
            // redirect after insert
                \redirect_header('lex__propertys.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__propertysObj->getHtmlErrors());
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PROPERTY_ADD];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__propertys.php?op=list', 3, \_NOPERM);
        }
        // Form Create
        $lex__propertysObj = $lex__propertysHandler->create();
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PROPERTY_EDIT];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__propertys.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $pptId) {
            \redirect_header('lex__propertys.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__propertysObj = $lex__propertysHandler->get($pptId);
        $lex__propertysObj->start = $start;
        $lex__propertysObj->limit = $limit;
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PROPERTY_CLONE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__propertys.php?op=list', 3, \_NOPERM);
        }
        // Request source
        $pptIdSource = Request::getInt('ppt_id_source');
        // Check params
        if (0 == $pptIdSource) {
            \redirect_header('lex__propertys.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__propertysObjSource = $lex__propertysHandler->get($pptIdSource);
        $lex__propertysObj = $lex__propertysObjSource->xoopsClone();
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PROPERTY_DELETE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__propertys.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $pptId) {
            \redirect_header('lex__propertys.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__propertysObj = $lex__propertysHandler->get($pptId);
        $_xyz_ = $lex__propertysObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__propertys.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__propertysHandler->delete($lex__propertysObj)) {
                \redirect_header('lex__propertys.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__propertysObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'ppt_id' => $pptId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__propertysObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_PROPERTYS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__propertys.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
