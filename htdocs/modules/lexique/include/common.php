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
if (!\defined('XOOPS_ICONS32_PATH')) {
    \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
    \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
\define('LEXIQUE_DIRNAME', 'lexique');
\define('LEXIQUE_PATH', \XOOPS_ROOT_PATH . '/modules/' . \LEXIQUE_DIRNAME);
\define('LEXIQUE_URL', \XOOPS_URL . '/modules/' . \LEXIQUE_DIRNAME);
\define('LEXIQUE_ICONS_PATH', \LEXIQUE_PATH . '/assets/icons');
\define('LEXIQUE_ICONS_URL', \LEXIQUE_URL . '/assets/icons');
\define('LEXIQUE_IMAGE_PATH', \LEXIQUE_PATH . '/assets/images');
\define('LEXIQUE_SEPARATORS_PATH', \LEXIQUE_PATH . '/assets/images/separators');
\define('LEXIQUE_IMAGE_URL', \LEXIQUE_URL . '/assets/images');
\define('LEXIQUE_SEPARATORS_URL', \LEXIQUE_URL . '/assets/images/separators');
\define('LEXIQUE_UPLOAD_PATH', \XOOPS_UPLOAD_PATH . '/' . \LEXIQUE_DIRNAME);
\define('LEXIQUE_UPLOAD_URL', \XOOPS_UPLOAD_URL . '/' . \LEXIQUE_DIRNAME);
\define('LEXIQUE_UPLOAD_FILES_PATH', \LEXIQUE_UPLOAD_PATH . '/files');
\define('LEXIQUE_UPLOAD_FILES_URL', \LEXIQUE_UPLOAD_URL . '/files');
\define('LEXIQUE_UPLOAD_IMAGE_PATH', \LEXIQUE_UPLOAD_PATH . '/images');
\define('LEXIQUE_UPLOAD_IMAGE_URL', \LEXIQUE_UPLOAD_URL . '/images');
\define('LEXIQUE_UPLOAD_SHOTS_PATH', \LEXIQUE_UPLOAD_PATH . '/images/shots');
\define('LEXIQUE_UPLOAD_SHOTS_URL', \LEXIQUE_UPLOAD_URL . '/images/shots');
\define('LEXIQUE_ADMIN', \LEXIQUE_URL . '/admin/index.php');
$localLogo = \LEXIQUE_IMAGE_URL . '/tdmxoops_logo.png';
// Module Information
$copyright = "<a href='https://oritheque.fr' title='Oritheque' target='_blank'><img src='" . $localLogo . "' alt='Oritheque' ></a>";
require_once \XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
require_once \LEXIQUE_PATH . '/include/functions.php';

//Type de données pour les proprietes
\define('LEXIQUE_TYPE_STRING', 0);    
\define('LEXIQUE_TYPE_NUM', 1);    
\define('LEXIQUE_TYPE_TEXT', 2);    
\define('LEXIQUE_TYPE_RICHTEXT', 2);
\define('LEXIQUE_TYPE_DATE', 4);    
\define('LEXIQUE_TYPE_IMAGE', 5);    
\define('LEXIQUE_TYPE_FILE', 6);    
\define('LEXIQUE_TYPE_LIST', 7);    

    
    
\define('LEXIQUE_SHOW_BOTH', 1);    
\define('LEXIQUE_SHOW_DATE', 0);    
\define('LEXIQUE_SHOW_TIME', 2);    
    

