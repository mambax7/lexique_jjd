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

$GLOBALS['xoTheme']->addStylesheet(LEXIQUE_URL . '/assets/css/separators.css');
$GLOBALS['xoTheme']->addScript(LEXIQUE_URL . '/assets/js/functions.js');

$dataType = $lex__datatypesHandler->getlist();
foreach($dataType AS $key=>$val) {
    \define('LEXIQUE_DTYPE_' . strtoupper($val), $key);  
    //echo "<br>" . 'LEXIQUE_DTYPE_' . strtoupper($val) . " = " . $key;        
}
