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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__terms.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op     = Request::getCmd('op', 'list');
$termId = Request::getInt('term_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('lexique_url', \LEXIQUE_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_INDEX, 'link' => 'index.php'];
// Permissions
$GLOBALS['xoopsTpl']->assign('showItem', $termId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_TERMS_LIST];
        $crLex__terms = new \CriteriaCompo();
        if ($termId > 0) {
            $crLex__terms->add(new \Criteria('term_id', $termId));
        }
        $lex__termsCount = $lex__termsHandler->getCount($crLex__terms);
        $GLOBALS['xoopsTpl']->assign('lex__termsCount', $lex__termsCount);
        if (0 === $termId) {
            $crLex__terms->setStart($start);
            $crLex__terms->setLimit($limit);
        }
        $lex__termsAll = $lex__termsHandler->getAll($crLex__terms);
        if ($lex__termsCount > 0) {
            $lex__terms = [];
            $ = '';
            // Get All Lex__terms
            foreach (\array_keys($lex__termsAll) as $i) {
                $lex__terms[$i] = $lex__termsAll[$i]->getValuesLex__terms();
                $_xyz_ = $lex__termsAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__terms', $lex__terms);
            unset($lex__terms);
            // Display Navigation
            if ($lex__termsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__termsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($ . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__terms.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($termId > 0) {
            $lex__termsObj = $lex__termsHandler->get($termId);
        } else {
            $lex__termsObj = $lex__termsHandler->create();
        }
        $uploaderErrors = '';
        $lex__termsObj->setVar('term_lex_id', Request::getInt('term_lex_id'));
        $lex__termsObj->setVar('term_letter', Request::getString('term_letter'));
        $lex__termsObj->setVar('term_name', Request::getString('term_name'));
        $lex__termsObj->setVar('term_short_def', Request::getString('term_short_def'));
        // Set Var term_image_1
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['term_image_1']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if ($uploader->upload()) {
                $lex__termsObj->setVar('term_image_1', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__termsObj->setVar('term_image_1', Request::getString('term_image_1'));
        }
        // Set Var term_image_2
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['term_image_2']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][1]);
            if ($uploader->upload()) {
                $lex__termsObj->setVar('term_image_2', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__termsObj->setVar('term_image_2', Request::getString('term_image_2'));
        }
        // Set Var term_image_3
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['term_image_3']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__terms/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][2])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][2]);
            if ($uploader->upload()) {
                $lex__termsObj->setVar('term_image_3', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__termsObj->setVar('term_image_3', Request::getString('term_image_3'));
        }
        $lex__termsObj->setVar('term_definition', Request::getText('term_definition'));
        $lex__termsObj->setVar('term_seealso', Request::getString('term_seealso'));
        $lex__termsObj->setVar('term_seealso_list', Request::getString('term_seealso_list'));
        $lex__termsObj->setVar('term_state', Request::getInt('term_state'));
        $lex__termsObj->setVar('term_visits', Request::getInt('term_visits'));
        $lex__termsObj->setVar('term_user_creation', Request::getString('term_user_creation'));
        $lex__termDate_creationArr = Request::getArray('term_date_creation');
        $lex__termDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__termDate_creationArr['date']);
        $lex__termDate_creationObj->setTime(0, 0, 0);
        $lex__termDate_creation = $lex__termDate_creationObj->getTimestamp() + (int)$lex__termDate_creationArr['time'];
        $lex__termsObj->setVar('term_date_creation', $lex__termDate_creation);
        $lex__termDate_modificationArr = Request::getArray('term_date_modification');
        $lex__termDate_modificationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__termDate_modificationArr['date']);
        $lex__termDate_modificationObj->setTime(0, 0, 0);
        $lex__termDate_modification = $lex__termDate_modificationObj->getTimestamp() + (int)$lex__termDate_modificationArr['time'];
        $lex__termsObj->setVar('term_date_modification', $lex__termDate_modification);
        // Insert Data
        if ($lex__termsHandler->insert($lex__termsObj)) {
            $newTermId = $termId > 0 ? $termId : $lex__termsObj->getNewInsertedIdLex__terms();
            // redirect after insert
            if ('' !== $uploaderErrors) {
                \redirect_header('lex__terms.php?op=edit&term_id=' . $newTermId, 5, $uploaderErrors);
            } else {
                \redirect_header('lex__terms.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
            }
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__termsObj->getHtmlErrors());
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_TERM_ADD];
        // Form Create
        $lex__termsObj = $lex__termsHandler->create();
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_TERM_EDIT];
        // Check params
        if (0 == $termId) {
            \redirect_header('lex__terms.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__termsObj = $lex__termsHandler->get($termId);
        $lex__termsObj->start = $start;
        $lex__termsObj->limit = $limit;
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_TERM_CLONE];
        // Request source
        $termIdSource = Request::getInt('term_id_source');
        // Check params
        if (0 == $termIdSource) {
            \redirect_header('lex__terms.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__termsObjSource = $lex__termsHandler->get($termIdSource);
        $lex__termsObj = $lex__termsObjSource->xoopsClone();
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_TERM_DELETE];
        // Check params
        if (0 == $termId) {
            \redirect_header('lex__terms.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__termsObj = $lex__termsHandler->get($termId);
        $_xyz_ = $lex__termsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__terms.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__termsHandler->delete($lex__termsObj)) {
                \redirect_header('lex__terms.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__termsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'term_id' => $termId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__termsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_TERMS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__terms.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

require __DIR__ . '/footer.php';
