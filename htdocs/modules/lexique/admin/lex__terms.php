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
use JJD;

require __DIR__ . '/header.php';
// Get all request values
$op     = Request::getCmd('op', 'list');
$termId = Request::getInt('term_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

$context = "&start={$start}&limit={$limit}";

switch ($op) {
    case 'save':
        include_once("lex__terms_{$op}.php");   
        break;         
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'lexique_admin_lex__terms.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__terms.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__TERM, 'lex__terms.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $lex__termsCount = $lex__termsHandler->getCountLex__terms();
        $lex__termsAll = $lex__termsHandler->getAllLex__terms($start, $limit);
        $GLOBALS['xoopsTpl']->assign('lex__terms_count', $lex__termsCount);
        $GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
        $GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('context', $context);
        
        // Table view lex__terms
        if ($lex__termsCount > 0) {
            foreach (\array_keys($lex__termsAll) as $i) {
                $lex__term = $lex__termsAll[$i]->getValuesLex__terms();
                $GLOBALS['xoopsTpl']->append('lex__terms_list', $lex__term);
                unset($lex__term);
            }
            // Display Navigation
            if ($lex__termsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__termsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_LEXIQUE_THEREARENT_LEX__TERMS);
        }
        break;
    case 'new':
        $templateMain = 'lexique_admin_lex__terms.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__terms.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__TERMS, 'lex__terms.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $lex__termsObj = $lex__termsHandler->create();
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'lexique_admin_lex__terms.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__terms.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__TERMS, 'lex__terms.php', 'list');
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__TERM, 'lex__terms.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $termIdSource = Request::getInt('term_id_source');
        // Get Form
        $lex__termsObjSource = $lex__termsHandler->get($termIdSource);
        $lex__termsObj = $lex__termsObjSource->xoopsClone();
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
//     case 'save':
//         // Security Check
//         if (!$GLOBALS['xoopsSecurity']->check()) {
//             \redirect_header('lex__terms.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
//         }
//         if ($termId > 0) {
//             $lex__termsObj = $lex__termsHandler->get($termId);
//         } else {
//             $lex__termsObj = $lex__termsHandler->create();
//         }
//         // Set Vars
//         $uploaderErrors = '';
//         $lex__termsObj->setVar('term_lex_id', Request::getInt('term_lex_id'));
//         $lex__termsObj->setVar('term_letter', Request::getString('term_letter'));
//         $lex__termsObj->setVar('term_letter', strtoupper(\JJD\enleve_accents(Request::getString('term_name'))));
//         $lex__termsObj->setVar('term_name', Request::getString('term_name'));
//         $lex__termsObj->setVar('term_short_def', Request::getString('term_short_def'));
//         // Set Var term_image_1
//         require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
//         $filename       = $_FILES['term_image_1']['name'];
//         $imgNameDef     = Request::getString('');
//         $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
//                                                     $helper->getConfig('mimetypes_file'), 
//                                                     $helper->getConfig('maxsize_file'), null, null);
//         if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
//             $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
//             $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
//             $uploader->setPrefix($imgName);
//             $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
//             if ($uploader->upload()) {
//                 $lex__termsObj->setVar('term_image_1', $uploader->getSavedFileName());
//             } else {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//         } else {
//             if ($filename > '') {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//             $lex__termsObj->setVar('term_image_1', Request::getString('term_image_1'));
//         }
//         // Set Var term_image_2
//         require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
//         $filename       = $_FILES['term_image_2']['name'];
//         $imgNameDef     = Request::getString('');
//         $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
//                                                     $helper->getConfig('mimetypes_file'), 
//                                                     $helper->getConfig('maxsize_file'), null, null);
//         if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
//             $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
//             $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
//             $uploader->setPrefix($imgName);
//             $uploader->fetchMedia($_POST['xoops_upload_file'][1]);
//             if ($uploader->upload()) {
//                 $lex__termsObj->setVar('term_image_2', $uploader->getSavedFileName());
//             } else {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//         } else {
//             if ($filename > '') {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//             $lex__termsObj->setVar('term_image_2', Request::getString('term_image_2'));
//         }
//         // Set Var term_image_3
//         require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
//         $filename       = $_FILES['term_image_3']['name'];
//         $imgNameDef     = Request::getString('');
//         $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
//                                                     $helper->getConfig('mimetypes_file'), 
//                                                     $helper->getConfig('maxsize_file'), null, null);
//         if ($uploader->fetchMedia($_POST['xoops_upload_file'][2])) {
//             $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
//             $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
//             $uploader->setPrefix($imgName);
//             $uploader->fetchMedia($_POST['xoops_upload_file'][2]);
//             if ($uploader->upload()) {
//                 $lex__termsObj->setVar('term_image_3', $uploader->getSavedFileName());
//             } else {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//         } else {
//             if ($filename > '') {
//                 $uploaderErrors .= '<br>' . $uploader->getErrors();
//             }
//             $lex__termsObj->setVar('term_image_3', Request::getString('term_image_3'));
//         }
//         $lex__termsObj->setVar('term_definition', Request::getText('term_definition'));
//         $lex__termsObj->setVar('term_seealso', Request::getString('term_seealso'));
//         $lex__termsObj->setVar('term_seealso_list', Request::getString('term_seealso_list'));
//         $lex__termsObj->setVar('term_state', Request::getInt('term_state'));
//         $lex__termsObj->setVar('term_visits', Request::getInt('term_visits'));
//         $lex__termsObj->setVar('term_user_creation', Request::getString('term_user_creation'));
//         $lex__termDate_creationArr = Request::getArray('term_date_creation');
//         $lex__termDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__termDate_creationArr['date']);
//         $lex__termDate_creationObj->setTime(0, 0, 0);
//         $lex__termDate_creation = $lex__termDate_creationObj->getTimestamp() + (int)$lex__termDate_creationArr['time'];
//         $lex__termsObj->setVar('term_date_creation', $lex__termDate_creation);
//         $lex__termDate_modificationArr = Request::getArray('term_date_modification');
//         $lex__termDate_modificationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__termDate_modificationArr['date']);
//         $lex__termDate_modificationObj->setTime(0, 0, 0);
//         $lex__termDate_modification = $lex__termDate_modificationObj->getTimestamp() + (int)$lex__termDate_modificationArr['time'];
//         $lex__termsObj->setVar('term_date_modification', $lex__termDate_modification);
//         // Insert Data
//         if ($lex__termsHandler->insert($lex__termsObj)) {
//             if ('' !== $uploaderErrors) {
//                 \redirect_header('lex__terms.php?op=edit&term_id=' . $termId, 5, $uploaderErrors);
//             } else {
//                 \redirect_header('lex__terms.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
//             }
//         }
//         // Get Form
//         $GLOBALS['xoopsTpl']->assign('error', $lex__termsObj->getHtmlErrors());
//         $form = $lex__termsObj->getFormLex__terms();
//         $GLOBALS['xoopsTpl']->assign('form', $form->render());
//         break;
    case 'edit':
        $templateMain = 'lexique_admin_lex__terms.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__terms.php'));
        $adminObject->addItemButton(\_AM_LEXIQUE_ADD_LEX__TERM, 'lex__terms.php?op=new');
        $adminObject->addItemButton(\_AM_LEXIQUE_LIST_LEX__TERMS, 'lex__terms.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $lex__termsObj = $lex__termsHandler->get($termId);
        $lex__termsObj->start = $start;
        $lex__termsObj->limit = $limit;
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'lexique_admin_lex__terms.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('lex__terms.php'));
        $lex__termsObj = $lex__termsHandler->get($termId);
        $_xyz_ = $lex__termsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__terms.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__termsHandler->delete($lex__termsObj)) {
                \redirect_header('lex__terms.php', 3, \_AM_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__termsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'term_id' => $termId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_LEXIQUE_FORM_SURE_DELETE, $lex__termsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;

    case 'incremente':
        $fldName = Request::getString('fld', 'ppt_active');
        $modMax = Request::getString('modMax', 2);
        
        $lex__termsHandler->incrementeField($termId, $fldName, $modMax, $newValue = null);
        \redirect_header("lex__terms.php?op=list" . $context, 0, "");
        break;

}
require __DIR__ . '/footer.php';
