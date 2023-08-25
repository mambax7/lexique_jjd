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

require \dirname(__DIR__, 3) . '/include/cp_header.php';
require_once \dirname(__DIR__) . '/include/common.php';
require_once \dirname(__DIR__) . '/class/lex__adoHandler.php';

$sysPathIcon16   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16   = \LEXIQUE_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons16') . '/';
$modPathIcon32   = \LEXIQUE_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons32') . '/';

xoops_load('XoopsFormLoader');

// Get instance of module
$helper = \XoopsModules\Lexique\Helper::getInstance();
$lex__itemsHandler = $helper->getHandler('Lex__items');
$lex__labelsHandler = $helper->getHandler('Lex__labels');
$lex__listsHandler = $helper->getHandler('Lex__lists');
$lex__paramsHandler = $helper->getHandler('Lex__params');
$lex__propertysHandler = $helper->getHandler('Lex__propertys');
$lex__termsHandler = $helper->getHandler('Lex__terms');
$lex__valuesHandler = $helper->getHandler('Lex__values');
$lex__datatypesHandler = $helper->getHandler('Lex__datatypes');

$myts = MyTextSanitizer::getInstance();
// 
if (!isset($xoopsTpl) || !\is_object($xoopsTpl)) {
    require_once \XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}

// Load languages
\xoops_loadLanguage('admin', 'lexique');
\xoops_loadLanguage('modinfo', 'lexique');
// \xoops_loadLanguage('main', 'lexique');


// Local admin menu class
if (\file_exists($GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php'))) {
    require_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
} else {
    \redirect_header('../../../admin.php', 5, \_AM_MODULEADMIN_MISSING);
}

xoops_cp_header();

// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);

$adminObject = \Xmf\Module\Admin::getInstance();
$style = \LEXIQUE_URL . '/assets/css/admin/style.css';

include_once (XOOPS_ROOT_PATH . "/Frameworks/JJD-Framework/load.php");
\jjd\loadAllXForms();   
\jjd\load_trierTableauHTML();

require_once \dirname(__DIR__) . '/include/common_header.php';