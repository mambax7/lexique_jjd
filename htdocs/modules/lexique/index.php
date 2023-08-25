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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_index.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_INDEX];
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
// Tables
$lex__itemsCount = $lex__itemsHandler->getCountLex__items();
$GLOBALS['xoopsTpl']->assign('lex__itemsCount', $lex__itemsCount);
$count = 1;
if ($lex__itemsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__itemsAll = $lex__itemsHandler->getAllLex__items($start, $limit);
    // Get All Lex__items
    $lex__items = [];
    foreach (\array_keys($lex__itemsAll) as $i) {
        $lex__item = $lex__itemsAll[$i]->getValuesLex__items();
        $acount = ['count', $count];
        $lex__items[] = \array_merge($lex__item, $acount);
        $keywords[] = $lex__itemsAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__items', $lex__items);
    unset($lex__items);
    // Display Navigation
    if ($lex__itemsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__itemsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__itemsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__labelsCount = $lex__labelsHandler->getCountLex__labels();
$GLOBALS['xoopsTpl']->assign('lex__labelsCount', $lex__labelsCount);
$count = 1;
if ($lex__labelsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__labelsAll = $lex__labelsHandler->getAllLex__labels($start, $limit);
    // Get All Lex__labels
    $lex__labels = [];
    foreach (\array_keys($lex__labelsAll) as $i) {
        $lex__label = $lex__labelsAll[$i]->getValuesLex__labels();
        $acount = ['count', $count];
        $lex__labels[] = \array_merge($lex__label, $acount);
        $keywords[] = $lex__labelsAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__labels', $lex__labels);
    unset($lex__labels);
    // Display Navigation
    if ($lex__labelsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__labelsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__labelsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__listsCount = $lex__listsHandler->getCountLex__lists();
$GLOBALS['xoopsTpl']->assign('lex__listsCount', $lex__listsCount);
$count = 1;
if ($lex__listsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__listsAll = $lex__listsHandler->getAllLex__lists($start, $limit);
    // Get All Lex__lists
    $lex__lists = [];
    foreach (\array_keys($lex__listsAll) as $i) {
        $lex__list = $lex__listsAll[$i]->getValuesLex__lists();
        $acount = ['count', $count];
        $lex__lists[] = \array_merge($lex__list, $acount);
        $keywords[] = $lex__listsAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__lists', $lex__lists);
    unset($lex__lists);
    // Display Navigation
    if ($lex__listsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__listsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__listsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__paramsCount = $lex__paramsHandler->getCountLex__params();
$GLOBALS['xoopsTpl']->assign('lex__paramsCount', $lex__paramsCount);
$count = 1;
if ($lex__paramsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__paramsAll = $lex__paramsHandler->getAllLex__params($start, $limit);
    // Get All Lex__params
    $lex__params = [];
    foreach (\array_keys($lex__paramsAll) as $i) {
        $lex__param = $lex__paramsAll[$i]->getValuesLex__params();
        $acount = ['count', $count];
        $lex__params[] = \array_merge($lex__param, $acount);
        $keywords[] = $lex__paramsAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__params', $lex__params);
    unset($lex__params);
    // Display Navigation
    if ($lex__paramsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__paramsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__paramsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__propertysCount = $lex__propertysHandler->getCountLex__propertys();
$GLOBALS['xoopsTpl']->assign('lex__propertysCount', $lex__propertysCount);
$count = 1;
if ($lex__propertysCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__propertysAll = $lex__propertysHandler->getAllLex__propertys(null, $start, $limit);
    // Get All Lex__propertys
    $lex__propertys = [];
    foreach (\array_keys($lex__propertysAll) as $i) {
        $lex__property = $lex__propertysAll[$i]->getValuesLex__propertys();
        $acount = ['count', $count];
        $lex__propertys[] = \array_merge($lex__property, $acount);
        $keywords[] = $lex__propertysAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__propertys', $lex__propertys);
    unset($lex__propertys);
    // Display Navigation
    if ($lex__propertysCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__propertysCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__propertysCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__termsCount = $lex__termsHandler->getCountLex__terms();
$GLOBALS['xoopsTpl']->assign('lex__termsCount', $lex__termsCount);
$count = 1;
if ($lex__termsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__termsAll = $lex__termsHandler->getAllLex__terms($start, $limit);
    // Get All Lex__terms
    $lex__terms = [];
    foreach (\array_keys($lex__termsAll) as $i) {
        $lex__term = $lex__termsAll[$i]->getValuesLex__terms();
        $acount = ['count', $count];
        $lex__terms[] = \array_merge($lex__term, $acount);
        $keywords[] = $lex__termsAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__terms', $lex__terms);
    unset($lex__terms);
    // Display Navigation
    if ($lex__termsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__termsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__termsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$lex__valuesCount = $lex__valuesHandler->getCountLex__values();
$GLOBALS['xoopsTpl']->assign('lex__valuesCount', $lex__valuesCount);
$count = 1;
if ($lex__valuesCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $lex__valuesAll = $lex__valuesHandler->getAllLex__values(null, $start, $limit);
    // Get All Lex__values
    $lex__values = [];
    foreach (\array_keys($lex__valuesAll) as $i) {
        $lex__value = $lex__valuesAll[$i]->getValuesLex__values();
        $acount = ['count', $count];
        $lex__values[] = \array_merge($lex__value, $acount);
        $keywords[] = $lex__valuesAll[$i]->getVar('');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('lex__values', $lex__values);
    unset($lex__values);
    // Display Navigation
    if ($lex__valuesCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($lex__valuesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_LEXIQUE_INDEX_THEREARE, $lex__valuesCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);
// Description
lexiqueMetaDescription(\_MA_LEXIQUE_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
require __DIR__ . '/footer.php';
