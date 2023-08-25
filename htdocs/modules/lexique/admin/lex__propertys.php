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
$pptId = Request::getInt('ppt_id');
$start = Request::getInt('start');
$limit = 50;//Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

$context = "&start={$start}&limit={$limit}";

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__propertys.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__propertys.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__PROPERTY, 'lex__propertys.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__propertysCount = $lex__propertysHandler->getCountLex__propertys();
        $lex__propertysAll = $lex__propertysHandler->getAllLex__propertys(null, $start, $limit,'ppt_weight,ppt_name');
        $GLOBALS['xoopsTpl']->assign('lex__propertys_count', $lex__propertysCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('context', $context);
        
        // Table view lex__propertys
        if ($lex__propertysCount > 0) {
            foreach (\array_keys($lex__propertysAll) as $i) {
                $lex__property = $lex__propertysAll[$i]->getValuesLex__propertys();
                $GLOBALS['xoopsTpl']->append('lex__propertys_list', $lex__property);
                unset($lex__property);
            }
            // Display Navigation
            if ($lex__propertysCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__propertysCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__PROPERTYS);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__propertys.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__propertys.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__PROPERTYS, 'lex__propertys.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__propertysObj = $lex__propertysHandler->create();
        $form = $lex__propertysObj->getFormLex__propertys_new();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'clone':
        $templateMain = 'lexique_admin_lex__propertys.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__propertys.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__PROPERTYS, 'lex__propertys.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__PROPERTY, 'lex__propertys.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $pptIdSource = Request::getInt('ppt_id_source');
        // Get Form
        $lex__propertysObjSource = $lex__propertysHandler->get($pptIdSource);
        $lex__propertysObj = $lex__propertysObjSource->xoopsClone(); 
        $lex__propertysObj->setVar('ppt_id', 0);
        $lex__propertysObj->setNew();
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());  
        break;
        
    case 'save_primary':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__propertys.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($pptId > 0) {
            $lex__propertysObj = $lex__propertysHandler->get($pptId);
        } else {
            $lex__propertysObj = $lex__propertysHandler->create();
        }
        // Set Vars
        $lex__propertysObj->setVar('ppt_list_id', Request::getInt('ppt_list_id'));
        $lex__propertysObj->setVar('ppt_dtype_id', Request::getInt('ppt_dtype_id'));
        $lex__propertysObj->setVar('ppt_name', Request::getString('ppt_name'));
        if ($lex__propertysHandler->insert($lex__propertysObj)) {
            $newPptId = $lex__propertysObj->getNewInsertedIdLex__propertys();
            \redirect_header("lex__propertys.php?op=edit&ppt_id={$newPptId}amp;start={$start}&limit={$limit}", 2, \_AM_LEXIQUE_FORM_OK);
         }
         
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__propertysObj->getHtmlErrors());
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__propertys.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($pptId > 0) {
            $lex__propertysObj = $lex__propertysHandler->get($pptId);
        } else {
            $lex__propertysObj = $lex__propertysHandler->create();
        }
        // Set Vars
        //$lex__prope  rtysObj->setVar('ppt_list_id', Request::getInt('ppt_list_id'));
        $lex__propertysObj->setVar('ppt_dtype_id', Request::getInt('ppt_dtype_id'));
        $lex__propertysObj->setVar('ppt_name', Request::getString('ppt_name'));
        $lex__propertysObj->setVar('ppt_active', Request::getInt('ppt_active'));
        $lex__propertysObj->setVar('ppt_weight', Request::getInt('ppt_weight'));
        $lex__propertysObj->setVar('ppt_css', Request::getText('ppt_css'));
        $lex__propertysObj->setVar('ppt_is_criteria', Request::getInt('ppt_is_criteria'));
        $lex__propertysObj->setVar('ppt_attributs', Request::getInt('ppt_attributs'));
        $lex__propertysObj->setVar('ppt_attributs', serialize(Request::getArray('ppt_attributs')));
        //$lex__propertysObj->setVar('ppt_attributs', serialize($_POST['ppt_attributs']));
        //$lex__propertysObj->setVar('ppt_attributs', utf8_encode(json_encode(Request::getArray('ppt_attributs'))));
        //$lex__propertysObj->setVar('ppt_attributs', json_encode(Request::getArray('ppt_attributs')));
        // Insert Data
        if ($lex__propertysHandler->insert($lex__propertysObj)) {
    //exit("<hr>ici<hr>");
//echo "<pre>" . print_r($_POST, true) . "</pre><hr>"; exit;
//echo "<pre>" . print_r($_POST['ppt_attributs'], true) . "</pre><hr>"; exit;
            $newPptId = $lex__propertysObj->getNewInsertedIdLex__propertys();
            $permId = isset($_REQUEST['ppt_id']) ? $pptId : $newPptId;
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_view_lex__propertys', $permId);
            if (isset($_POST['groups_view_lex__propertys'])) {
                foreach ($_POST['groups_view_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_view_lex__propertys', $permId, $onegroupId, $mid);
                }
            }
            // Permission to submit_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_submit_lex__propertys', $permId);
            if (isset($_POST['groups_submit_lex__propertys'])) {
                foreach ($_POST['groups_submit_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_submit_lex__propertys', $permId, $onegroupId, $mid);
                }
            }
            // Permission to approve_lex__propertys
            $grouppermHandler->deleteByModule($mid, 'lexique_approve_lex__propertys', $permId);
            if (isset($_POST['groups_approve_lex__propertys'])) {
                foreach ($_POST['groups_approve_lex__propertys'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_approve_lex__propertys', $permId, $onegroupId, $mid);
                }
            }
                \redirect_header('lex__propertys.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__propertysObj->getHtmlErrors());
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'edit':
        $templateMain = 'lexique_admin_lex__propertys.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__propertys.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__PROPERTY, 'lex__propertys.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__PROPERTYS, 'lex__propertys.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__propertysObj = $lex__propertysHandler->get($pptId);
        $lex__propertysObj->start = $start;
        $lex__propertysObj->limit = $limit;
        $form = $lex__propertysObj->getFormLex__propertys();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__propertys.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__propertys.php'));
        $lex__propertysObj = $lex__propertysHandler->get($pptId);
        $_xyz_ = $lex__propertysObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__propertys.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__propertysHandler->delete($lex__propertysObj)) {
                \redirect_header('lex__propertys.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__propertysObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'ppt_id' => $pptId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__propertysObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;

    case 'update_weight':
        $action = Request::getCmd('action');
        $pptId = Request::getInt('pptId', 0);
        //$albPid = Request::getInt('albPid', 0);
        $lex__propertysHandler->updateWeight($pptId, $action);
        \redirect_header('lex__propertys.php?op=list' . $context, 2, \_AM_leXIQUE_WEIGHT_UPDATE);    
        break;
        
    case 'incremente':
        $fldName = Request::getString('fld', 'ppt_active');
        $lex__propertysHandler->incrementeField($pptId, $fldName, $modMax = 2, $newValue = null);
        \redirect_header("lex__propertys.php?op=list" . $context, 0, "");
        break;

}
require __DIR__ . '/footer.php';
