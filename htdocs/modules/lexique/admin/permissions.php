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

require __DIR__ . '/header.php';

// Template Index
$templateMain = 'lexique_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));

$op = Request::getCmd('op', 'global');

// Get Form
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_AM_LEXIQUE_PERMISSIONS_GLOBAL);
$formSelect->addOption('approve_lex__params', \_AM_LEXIQUE_PERMISSIONS_APPROVE . ' Lex__params');
$formSelect->addOption('submit_lex__params', \_AM_LEXIQUE_PERMISSIONS_SUBMIT . ' Lex__params');
$formSelect->addOption('view_lex__params', \_AM_LEXIQUE_PERMISSIONS_VIEW . ' Lex__params');
$formSelect->addOption('approve_lex__propertys', \_AM_LEXIQUE_PERMISSIONS_APPROVE . ' Lex__propertys');
$formSelect->addOption('submit_lex__propertys', \_AM_LEXIQUE_PERMISSIONS_SUBMIT . ' Lex__propertys');
$formSelect->addOption('view_lex__propertys', \_AM_LEXIQUE_PERMISSIONS_VIEW . ' Lex__propertys');
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_GLOBAL;
        $permName = 'lexique_ac';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_GLOBAL_DESC;
        $globalPerms = ['4' => \_AM_LEXIQUE_PERMISSIONS_GLOBAL_4, '8' => \_AM_LEXIQUE_PERMISSIONS_GLOBAL_8, '16' => \_AM_LEXIQUE_PERMISSIONS_GLOBAL_16 ];
        break;
    case 'approve_lex__params':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_APPROVE;
        $permName = 'lexique_approve_lex__params';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_APPROVE_DESC . ' Lex__params';
        $handler = $helper->getHandler('lex__params');
        break;
    case 'submit_lex__params':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_SUBMIT;
        $permName = 'lexique_submit_lex__params';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_SUBMIT_DESC . ' Lex__params';
        $handler = $helper->getHandler('lex__params');
        break;
    case 'view_lex__params':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_VIEW;
        $permName = 'lexique_view_lex__params';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_VIEW_DESC . ' Lex__params';
        $handler = $helper->getHandler('lex__params');
        break;
    case 'approve_lex__propertys':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_APPROVE;
        $permName = 'lexique_approve_lex__propertys';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_APPROVE_DESC . ' Lex__propertys';
        $handler = $helper->getHandler('lex__propertys');
        break;
    case 'submit_lex__propertys':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_SUBMIT;
        $permName = 'lexique_submit_lex__propertys';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_SUBMIT_DESC . ' Lex__propertys';
        $handler = $helper->getHandler('lex__propertys');
        break;
    case 'view_lex__propertys':
        $formTitle = \_AM_LEXIQUE_PERMISSIONS_VIEW;
        $permName = 'lexique_view_lex__propertys';
        $permDesc = \_AM_LEXIQUE_PERMISSIONS_VIEW_DESC . ' Lex__propertys';
        $handler = $helper->getHandler('lex__propertys');
        break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
$permFound = false;
if ($op === 'global') {
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    $permFound = true;
}
if ('approve_lex__params' === $op || 'submit_lex__params' === $op || 'view_lex__params' === $op) {
    $lex__paramsCount = $lex__paramsHandler->getCountLex__params();
    if ($lex__paramsCount > 0) {
        $lex__paramsAll = $lex__paramsHandler->getAllLex__params(0, 'title');
        foreach (\array_keys($lex__paramsAll) as $i) {
            $permform->addItem($lex__paramsAll[$i]->getVar('lex_id'), $lex__paramsAll[$i]->getVar('title'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    }
    $permFound = true;
}
if ('approve_lex__propertys' === $op || 'submit_lex__propertys' === $op || 'view_lex__propertys' === $op) {
    $lex__propertysCount = $lex__propertysHandler->getCountLex__propertys();
    if ($lex__propertysCount > 0) {
        $lex__propertysAll = $lex__propertysHandler->getAllLex__propertys(null,0,0, 'title');
        foreach (\array_keys($lex__propertysAll) as $i) {
            $permform->addItem($lex__propertysAll[$i]->getVar('ppt_id'), $lex__propertysAll[$i]->getVar('title'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    }
    $permFound = true;
}
unset($permform);
if (true !== $permFound) {
    \redirect_header('permissions.php', 3, \_AM_LEXIQUE_NO_PERMISSIONS_SET);
    exit();
}
require __DIR__ . '/footer.php';
