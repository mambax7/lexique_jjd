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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__labels.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$labId = Request::getInt('lab_id');
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
$GLOBALS['xoopsTpl']->assign('showItem', $labId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LABELS_LIST];
        $crLex__labels = new \CriteriaCompo();
        if ($labId > 0) {
            $crLex__labels->add(new \Criteria('lab_id', $labId));
        }
        $lex__labelsCount = $lex__labelsHandler->getCount($crLex__labels);
        $GLOBALS['xoopsTpl']->assign('lex__labelsCount', $lex__labelsCount);
        if (0 === $labId) {
            $crLex__labels->setStart($start);
            $crLex__labels->setLimit($limit);
        }
        $lex__labelsAll = $lex__labelsHandler->getAll($crLex__labels);
        if ($lex__labelsCount > 0) {
            $lex__labels = [];
            $ = '';
            // Get All Lex__labels
            foreach (\array_keys($lex__labelsAll) as $i) {
                $lex__labels[$i] = $lex__labelsAll[$i]->getValuesLex__labels();
                $_xyz_ = $lex__labelsAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__labels', $lex__labels);
            unset($lex__labels);
            // Display Navigation
            if ($lex__labelsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__labelsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
            \redirect_header('lex__labels.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($labId > 0) {
            $lex__labelsObj = $lex__labelsHandler->get($labId);
        } else {
            $lex__labelsObj = $lex__labelsHandler->create();
        }
        $lex__labelsObj->setVar('lab_lex_id', Request::getInt('lab_lex_id'));
        $lex__labelsObj->setVar('lab_code', Request::getString('lab_code'));
        $lex__labelsObj->setVar('lab_label', Request::getString('lab_label'));
        // Insert Data
        if ($lex__labelsHandler->insert($lex__labelsObj)) {
            // redirect after insert
                \redirect_header('lex__labels.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__labelsObj->getHtmlErrors());
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LABEL_ADD];
        // Form Create
        $lex__labelsObj = $lex__labelsHandler->create();
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LABEL_EDIT];
        // Check params
        if (0 == $labId) {
            \redirect_header('lex__labels.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__labelsObj = $lex__labelsHandler->get($labId);
        $lex__labelsObj->start = $start;
        $lex__labelsObj->limit = $limit;
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LABEL_CLONE];
        // Request source
        $labIdSource = Request::getInt('lab_id_source');
        // Check params
        if (0 == $labIdSource) {
            \redirect_header('lex__labels.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__labelsObjSource = $lex__labelsHandler->get($labIdSource);
        $lex__labelsObj = $lex__labelsObjSource->xoopsClone();
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_LABEL_DELETE];
        // Check params
        if (0 == $labId) {
            \redirect_header('lex__labels.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__labelsObj = $lex__labelsHandler->get($labId);
        $_xyz_ = $lex__labelsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__labels.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__labelsHandler->delete($lex__labelsObj)) {
                \redirect_header('lex__labels.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__labelsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'lab_id' => $labId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__labelsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_LABELS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__labels.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
