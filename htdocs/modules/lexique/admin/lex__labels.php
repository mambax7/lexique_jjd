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
$labId = Request::getInt('lab_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__labels.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__labels.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LABEL, 'lex__labels.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__labelsCount = $lex__labelsHandler->getCountLex__labels();
        $lex__labelsAll = $lex__labelsHandler->getAllLex__labels($start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__labels_count', $lex__labelsCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        // Table view lex__labels
        if ($lex__labelsCount > 0) {
            foreach (\array_keys($lex__labelsAll) as $i) {
                $lex__label = $lex__labelsAll[$i]->getValuesLex__labels();
                $GLOBALS['xoopsTpl']->append('lex__labels_list', $lex__label);
                unset($lex__label);
            }
            // Display Navigation
            if ($lex__labelsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__labelsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__LABELS);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__labels.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__labels.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LABELS, 'lex__labels.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__labelsObj = $lex__labelsHandler->create();
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__labels.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__labels.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LABELS, 'lex__labels.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LABEL, 'lex__labels.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $labIdSource = Request::getInt('lab_id_source');
        // Get Form
        $lex__labelsObjSource = $lex__labelsHandler->get($labIdSource);
        $lex__labelsObj = $lex__labelsObjSource->xoopsClone();
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
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
        // Set Vars
        $lex__labelsObj->setVar('lab_lex_id', Request::getInt('lab_lex_id'));
        $lex__labelsObj->setVar('lab_code', Request::getString('lab_code'));
        $lex__labelsObj->setVar('lab_label', Request::getString('lab_label'));
        // Insert Data
        if ($lex__labelsHandler->insert($lex__labelsObj)) {
                \redirect_header('lex__labels.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__labelsObj->getHtmlErrors());
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__labels.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__labels.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__LABEL, 'lex__labels.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__LABELS, 'lex__labels.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__labelsObj = $lex__labelsHandler->get($labId);
        $lex__labelsObj->start = $start;
        $lex__labelsObj->limit = $limit;
        $form = $lex__labelsObj->getFormLex__labels();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__labels.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__labels.php'));
        $lex__labelsObj = $lex__labelsHandler->get($labId);
        $_xyz_ = $lex__labelsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__labels.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__labelsHandler->delete($lex__labelsObj)) {
                \redirect_header('lex__labels.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__labelsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'lab_id' => $labId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__labelsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
