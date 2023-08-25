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

$dirname       = \basename(\dirname(__DIR__));
$moduleHandler = \xoops_getHandler('module');
$xoopsModule   = XoopsModule::getByDirname($dirname);
$moduleInfo    = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU1,
    'link' => 'admin/index.php',
    'icon' => $sysPathIcon32.'/dashboard.png',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU5,
    'link' => 'admin/lex__params.php',
    'icon' => 'assets/icons/32/',
];

$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU7,
    'link' => 'admin/lex__terms.php',
    'icon' => 'assets/icons/32/',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU3,
    'link' => 'admin/lex__labels.php',
    'icon' => 'assets/icons/32/',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU2,
    'link' => 'admin/lex__items.php',
    'icon' => 'assets/icons/32/',
];

$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU6,
    'link' => 'admin/lex__propertys.php',
    'icon' => 'assets/icons/32/',
];

$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU12,
    'link' => 'admin/lex__datatypes.php',
    'icon' => 'assets/icons/32/blank.gif',
];

/*
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU4,
    'link' => 'admin/lex__lists.php',
    'icon' => 'assets/icons/32/',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU8,
    'link' => 'admin/lex__values.php',
    'icon' => 'assets/icons/32/',
];
*/

$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU9,
    'link' => 'admin/permissions.php',
    'icon' => $sysPathIcon32.'/permissions.png',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU10,
    'link' => 'admin/clone.php',
    'icon' => $sysPathIcon32.'/page_copy.png',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ADMENU11,
    'link' => 'admin/feedback.php',
    'icon' => $sysPathIcon32.'/mail_foward.png',
];
$adminmenu[] = [
    'title' => \_MI_LEXIQUE_ABOUT,
    'link' => 'admin/about.php',
    'icon' => $sysPathIcon32.'/about.png',
];
