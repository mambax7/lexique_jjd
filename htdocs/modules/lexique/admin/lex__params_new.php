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

//require __DIR__ . '/header.php';
// Get all request values
    
$op    = Request::getCmd('op', 'list');
$lexId = Request::getInt('lex_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);


    //test de duplication de tble    
    $lex__paramsHandler->killlex('togodo'); 
    $lex__paramsHandler->dublicate_all_tables("togodo");
// tirol    
    
//    $lex__paramsHandler->killlex('tirol'); 
    
    
       
    $lex__paramsHandler->getSqlPrefixList();    
    //$lex__paramsHandler->getAllArr();
    $lex__paramsHandler->getListArr();
    
    $zzz = $lex__paramsHandler->getLexValues();
    echo "<pre>zzz =>  : " . print_r($zzz, true) . "</pre><br>============================<br>";    
    
exit ("<br>===> lexique default = {$lex__paramsHandler->lexDefault}<hr>");          

/*
*/
        $templateMain = 'lexique_admin_lex__params.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__params.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__PARAMS, 'lex__params.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__paramsObj = $lex__paramsHandler->create();
        $form = $lex__paramsObj->getFormLex__params();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());





//require __DIR__ . '/footer.php';
