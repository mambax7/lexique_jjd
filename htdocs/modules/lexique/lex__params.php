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
$GLOBALS['xoopsOption']['template_main'] = 'lexique_lex__params.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$lexId = Request::getInt('lex_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
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
$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $lexId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PARAMS_LIST];
        $crLex__params = new \CriteriaCompo();
        if ($lexId > 0) {
            $crLex__params->add(new \Criteria('lex_id', $lexId));
        }
        $lex__paramsCount = $lex__paramsHandler->getCount($crLex__params);
        $GLOBALS['xoopsTpl']->assign('lex__paramsCount', $lex__paramsCount);
        if (0 === $lexId) {
            $crLex__params->setStart($start);
            $crLex__params->setLimit($limit);
        }
        $lex__paramsAll = $lex__paramsHandler->getAll($crLex__params);
        if ($lex__paramsCount > 0) {
            $lex__params = [];
            $ = '';
            // Get All Lex__params
            foreach (\array_keys($lex__paramsAll) as $i) {
                $lex__params[$i] = $lex__paramsAll[$i]->getValuesLex__params();
                $_xyz_ = $lex__paramsAll[$i]->getVar('');
                $keywords[$i] = $_xyz_;
            }
            $GLOBALS['xoopsTpl']->assign('lex__params', $lex__params);
            unset($lex__params);
            // Display Navigation
            if ($lex__paramsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($lex__paramsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
            \redirect_header('lex__params.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__params.php?op=list', 3, \_NOPERM);
        }
        if ($lexId > 0) {
            $lex__paramsObj = $lex__paramsHandler->get($lexId);
        } else {
            $lex__paramsObj = $lex__paramsHandler->create();
        }
        $uploaderErrors = '';
        $lex__paramsObj->setVar('lex_sql_prefix', Request::getString('lex_sql_prefix'));
        $lex__paramsObj->setVar('lex_category', Request::getString('lex_category'));
        $lex__paramsObj->setVar('lex_name', Request::getString('lex_name'));
        $lex__paramsObj->setVar('lex_icon', Request::getString('lex_icon'));
        $lex__paramsObj->setVar('lex_icon_width', Request::getInt('lex_icon_width'));
        $lex__paramsObj->setVar('lex_description', Request::getText('lex_description'));
        $lex__paramsObj->setVar('lex_actif', Request::getInt('lex_actif'));
        $lex__paramsObj->setVar('lex_weight', Request::getInt('lex_weight'));
        $lex__paramsObj->setVar('lex_default', Request::getInt('lex_default'));
        $lex__paramsObj->setVar('lex_seealso_mode', Request::getInt('lex_seealso_mode'));
        $lex__paramsObj->setVar('lex_bin_menus', Request::getInt('lex_bin_menus'));
        $lex__paramsObj->setVar('lex_buttons_position', Request::getInt('lex_buttons_position'));
        $lex__paramsObj->setVar('lex_group_id_mail', Request::getInt('lex_group_id_mail'));
        $lex__paramsObj->setVar('lex_bin_search', Request::getInt('lex_bin_search'));
        $lex__paramsObj->setVar('lex_note_min', Request::getInt('lex_note_min'));
        $lex__paramsObj->setVar('lex_note_max', Request::getInt('lex_note_max'));
        // Set Var lex_note_img
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['lex_note_img']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__params/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if ($uploader->upload()) {
                $lex__paramsObj->setVar('lex_note_img', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__paramsObj->setVar('lex_note_img', Request::getString('lex_note_img'));
        }
        $lex__paramsObj->setVar('lex_selector_caracters', Request::getString('lex_selector_caracters'));
        $lex__paramsObj->setVar('lex_selector_numerique', Request::getString('lex_selector_numerique'));
        $lex__paramsObj->setVar('lex_selector_other', Request::getString('lex_selector_other'));
        $lex__paramsObj->setVar('lex_selector_show_all', Request::getInt('lex_selector_show_all'));
        $lex__paramsObj->setVar('lex_selector_frames_delimitor', Request::getString('lex_selector_frames_delimitor'));
        $lex__paramsObj->setVar('lex_selector_letters_separator', Request::getString('lex_selector_letters_separator'));
        $lex__paramsObj->setVar('lex_selector_css_enabled', Request::getString('lex_selector_css_enabled'));
        $lex__paramsObj->setVar('lex_selector_css_selected', Request::getString('lex_selector_css_selected'));
        $lex__paramsObj->setVar('lex_selector_css_disabled', Request::getString('lex_selector_css_disabled'));
        // Set Var lex_bandeau
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['lex_bandeau']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__params/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][1]);
            if ($uploader->upload()) {
                $lex__paramsObj->setVar('lex_bandeau', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__paramsObj->setVar('lex_bandeau', Request::getString('lex_bandeau'));
        }
        // Set Var lex_bandeau_css
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['lex_bandeau_css']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__params/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][2])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][2]);
            if ($uploader->upload()) {
                $lex__paramsObj->setVar('lex_bandeau_css', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__paramsObj->setVar('lex_bandeau_css', Request::getString('lex_bandeau_css'));
        }
        $lex__paramsObj->setVar('lex_term_admin_pager', Request::getInt('lex_term_admin_pager'));
        $lex__paramsObj->setVar('lex_term_user_pager', Request::getInt('lex_term_user_pager'));
        // Set Var lex_term_img_css
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['lex_term_img_css']['name'];
        $imgNameDef     = Request::getString('');
        $uploader = new \XoopsMediaUploader(\LEXIQUE_UPLOAD_FILES_PATH . '/lex__params/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][3])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][3]);
            if ($uploader->upload()) {
                $lex__paramsObj->setVar('lex_term_img_css', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $lex__paramsObj->setVar('lex_term_img_css', Request::getString('lex_term_img_css'));
        }
        $lex__paramsObj->setVar('lex_terms_visits', Request::getInt('lex_terms_visits'));
        $lex__paramDate_creationArr = Request::getArray('lex_date_creation');
        $lex__paramDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__paramDate_creationArr['date']);
        $lex__paramDate_creationObj->setTime(0, 0, 0);
        $lex__paramDate_creation = $lex__paramDate_creationObj->getTimestamp() + (int)$lex__paramDate_creationArr['time'];
        $lex__paramsObj->setVar('lex_date_creation', $lex__paramDate_creation);
        $lex__paramDate_modificationArr = Request::getArray('lex_date_modification');
        $lex__paramDate_modificationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $lex__paramDate_modificationArr['date']);
        $lex__paramDate_modificationObj->setTime(0, 0, 0);
        $lex__paramDate_modification = $lex__paramDate_modificationObj->getTimestamp() + (int)$lex__paramDate_modificationArr['time'];
        $lex__paramsObj->setVar('lex_date_modification', $lex__paramDate_modification);
        $lex__paramsObj->setVar('lex_note_count', Request::getInt('lex_note_count'));
        $lex__paramsObj->setVar('lex_note_sum', Request::getInt('lex_note_sum'));
        $lex__paramsObj->setVar('lex_note_average', Request::getFloat('lex_note_average'));
        $lex__paramsObj->setVar('lex_editor', Request::getString('lex_editor'));
        $lex__paramsObj->setVar('lex_pos_Image_1', Request::getInt('lex_pos_Image_1'));
        $lex__paramsObj->setVar('lex_bin_show', Request::getInt('lex_bin_show'));
        // Insert Data
        if ($lex__paramsHandler->insert($lex__paramsObj)) {
            $newLexId = $lexId > 0 ? $lexId : $lex__paramsObj->getNewInsertedIdLex__params();
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_lex__params
            $grouppermHandler->deleteByModule($mid, 'lexique_view_lex__params', $newLexId);
            if (isset($_POST['groups_view_lex__params'])) {
                foreach ($_POST['groups_view_lex__params'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_view_lex__params', $newLexId, $onegroupId, $mid);
                }
            }
            // Permission to submit_lex__params
            $grouppermHandler->deleteByModule($mid, 'lexique_submit_lex__params', $newLexId);
            if (isset($_POST['groups_submit_lex__params'])) {
                foreach ($_POST['groups_submit_lex__params'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_submit_lex__params', $newLexId, $onegroupId, $mid);
                }
            }
            // Permission to approve_lex__params
            $grouppermHandler->deleteByModule($mid, 'lexique_approve_lex__params', $newLexId);
            if (isset($_POST['groups_approve_lex__params'])) {
                foreach ($_POST['groups_approve_lex__params'] as $onegroupId) {
                    $grouppermHandler->addRight('lexique_approve_lex__params', $newLexId, $onegroupId, $mid);
                }
            }
            // redirect after insert
            if ('' !== $uploaderErrors) {
                \redirect_header('lex__params.php?op=edit&lex_id=' . $newLexId, 5, $uploaderErrors);
            } else {
                \redirect_header('lex__params.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_LEXIQUE_FORM_OK);
            }
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $lex__paramsObj->getHtmlErrors());
        $form = $lex__paramsObj->getFormLex__params();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PARAM_ADD];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__params.php?op=list', 3, \_NOPERM);
        }
        // Form Create
        $lex__paramsObj = $lex__paramsHandler->create();
        $form = $lex__paramsObj->getFormLex__params();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PARAM_EDIT];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__params.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $lexId) {
            \redirect_header('lex__params.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__paramsObj = $lex__paramsHandler->get($lexId);
        $lex__paramsObj->start = $start;
        $lex__paramsObj->limit = $limit;
        $form = $lex__paramsObj->getFormLex__params();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PARAM_CLONE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__params.php?op=list', 3, \_NOPERM);
        }
        // Request source
        $lexIdSource = Request::getInt('lex_id_source');
        // Check params
        if (0 == $lexIdSource) {
            \redirect_header('lex__params.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        // Get Form
        $lex__paramsObjSource = $lex__paramsHandler->get($lexIdSource);
        $lex__paramsObj = $lex__paramsObjSource->xoopsClone();
        $form = $lex__paramsObj->getFormLex__params();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_LEXIQUE_PARAM_DELETE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('lex__params.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $lexId) {
            \redirect_header('lex__params.php?op=list', 3, \_MA_LEXIQUE_INVALID_PARAM);
        }
        $lex__paramsObj = $lex__paramsHandler->get($lexId);
        $_xyz_ = $lex__paramsObj->getVar('');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('lex__params.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($lex__paramsHandler->delete($lex__paramsObj)) {
                \redirect_header('lex__params.php', 3, \_MA_LEXIQUE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $lex__paramsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'lex_id' => $lexId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_LEXIQUE_FORM_SURE_DELETE, $lex__paramsObj->getVar('')));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Keywords
lexiqueMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
lexiqueMetaDescription(\_MA_LEXIQUE_PARAMS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \LEXIQUE_URL.'/lex__params.php');
$GLOBALS['xoopsTpl']->assign('lexique_upload_url', \LEXIQUE_UPLOAD_URL);

// View comments
require_once \XOOPS_ROOT_PATH . '/include/comment_view.php';

require __DIR__ . '/footer.php';
