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
 * builddatatype module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

use Xmf\Request;
use XoopsModules\Lexique;
use XoopsModules\Lexique\Constants;
use XoopsModules\Lexique\Common;

require __DIR__ . '/header.php';
// Get all request values
$op      = Request::getCmd('op', 'list');
$dtypeId = Request::getInt('dtype_id');
$start   = Request::getInt('start');
$limit   = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__datatypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__datatypes.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__DATATYPE, 'lex__datatypes.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__datatypesCount = $lex__datatypesHandler->getCountLex__datatypes();
        $lex__datatypesAll = $lex__datatypesHandler->getAllLex__datatypes($start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__datatypes_count', $lex__datatypesCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        // Table view lex__datatypes
        if ($lex__datatypesCount > 0) {
            foreach (\array_keys($lex__datatypesAll) as $i) {
                $lex__datatype = $lex__datatypesAll[$i]->getValuesLex__datatypes();
                $GLOBALS['xoopsTpl']->append('lex__datatypes_list', $lex__datatype);
                unset($lex__datatype);
            }
            // Display Navigation
            if ($lex__datatypesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__datatypesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__DATATYPES);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__datatypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__datatypes.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__DATATYPES, 'lex__datatypes.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__datatypesObj = $lex__datatypesHandler->create();
        $form = $lex__datatypesObj->getFormLex__datatypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__datatypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__datatypes.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__DATATYPES, 'lex__datatypes.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__DATATYPE, 'lex__datatypes.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $dtypeIdSource = Request::getInt('dtype_id_source');
        // Get Form
        $lex__datatypesObjSource = $lex__datatypesHandler->get($dtypeIdSource);
        $lex__datatypesObj = $lex__datatypesObjSource->xoopsClone();
        $form = $lex__datatypesObj->getFormLex__datatypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__datatypes.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($dtypeId > 0) {
            $lex__datatypesObj = $lex__datatypesHandler->get($dtypeId);
        } else {
            $lex__datatypesObj = $lex__datatypesHandler->create();
        }
        // Set Vars
        $lex__datatypesObj->setVar('dtype_name', Request::getString('dtype_name'));
        $lex__datatypesObj->setVar('dtype_attributs', Request::getString('dtype_attributs'));
        // Insert Data
        if ($lex__datatypesHandler->insert($lex__datatypesObj)) {
                \redirect_header('lex__datatypes.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__datatypesObj->getHtmlErrors());
        $form = $lex__datatypesObj->getFormLex__datatypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__datatypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__datatypes.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__DATATYPE, 'lex__datatypes.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__DATATYPES, 'lex__datatypes.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__datatypesObj = $lex__datatypesHandler->get($dtypeId);
        $lex__datatypesObj->start = $start;
        $lex__datatypesObj->limit = $limit;
        $form = $lex__datatypesObj->getFormLex__datatypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__datatypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__datatypes.php'));
        $lex__datatypesObj = $lex__datatypesHandler->get($dtypeId);
        $dtypeName = $lex__datatypesObj->getVar('dtype_name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__datatypes.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__datatypesHandler->delete($lex__datatypesObj)) {
                \redirect_header('lex__datatypes.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__datatypesObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'dtype_id' => $dtypeId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__datatypesObj->getVar('dtype_name')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
