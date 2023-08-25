<?php

declare(strict_types=1);


namespace XoopsModules\Lexique;

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

use XoopsModules\Lexique;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Lex__params
 */
class Lex__params extends \XoopsObject
{
    /**
     * @var int
     */
    public $start = 0;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('lex_id', \XOBJ_DTYPE_INT);
        $this->initVar('lex_sql_prefix', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_category', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_icon', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_icon_width', \XOBJ_DTYPE_INT);
        $this->initVar('lex_description', \XOBJ_DTYPE_OTHER);
        $this->initVar('lex_actif', \XOBJ_DTYPE_INT);
        $this->initVar('lex_weight', \XOBJ_DTYPE_INT);
        $this->initVar('lex_default', \XOBJ_DTYPE_INT);
        $this->initVar('lex_seealso_mode', \XOBJ_DTYPE_INT);
        $this->initVar('lex_bin_menus', \XOBJ_DTYPE_INT);
        $this->initVar('lex_buttons_position', \XOBJ_DTYPE_INT);
        $this->initVar('lex_group_id_mail', \XOBJ_DTYPE_INT);
        $this->initVar('lex_bin_search', \XOBJ_DTYPE_INT);
        $this->initVar('lex_note_min', \XOBJ_DTYPE_INT);
        $this->initVar('lex_note_max', \XOBJ_DTYPE_INT);
        $this->initVar('lex_note_img', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_caracters', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_numerique', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_other', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_show_all', \XOBJ_DTYPE_INT);
        $this->initVar('lex_selector_frames_delimitor', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_letters_separator', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_selector_css_enabled', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('lex_selector_css_selected', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('lex_selector_css_disabled', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('lex_bandeau', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_bandeau_css', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('lex_term_admin_pager', \XOBJ_DTYPE_INT);
        $this->initVar('lex_term_user_pager', \XOBJ_DTYPE_INT);
        $this->initVar('lex_term_img_css', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('lex_terms_visits', \XOBJ_DTYPE_INT);
        $this->initVar('lex_date_creation', \XOBJ_DTYPE_LTIME);
        $this->initVar('lex_date_modification', \XOBJ_DTYPE_LTIME);
        $this->initVar('lex_note_count', \XOBJ_DTYPE_INT);
        $this->initVar('lex_note_sum', \XOBJ_DTYPE_INT);
        $this->initVar('lex_note_average', \XOBJ_DTYPE_DECIMAL);
        $this->initVar('lex_editor', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lex_pos_Image_1', \XOBJ_DTYPE_INT);
        $this->initVar('lex_bin_show', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     * @return inserted id
     */
    public function getNewInsertedIdLex__params()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__params($action = false)
    {
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $memberHandler = \xoops_getHandler('member');
        $editorHandler = \xoops_getHandler('editor');

        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_PARAM_ADD : \_AM_LEXIQUE_PARAM_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        
        
        // Form Text lexId   JJDai : inutile d'afficher l'id qui sera toujours 1
        $form->addElement(new \XoopsFormHidden(\_AM_LEXIQUE_PARAM_ID, 'lex_id', 50, 255, $this->getVar('lex_id')));
        // Form Text lexName
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NAME, 'lex_name', 50, 255, $this->getVar('lex_name')));
        
        // Form Editor DhtmlTextArea lexDescription
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
        $editorConfigs['name'] = 'lex_description';
        $editorConfigs['value'] = $this->getVar('lex_description', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_AM_LEXIQUE_PARAM_DESCRIPTION, 'lex_description', $editorConfigs));
        
        //-----------------------------------------
        // Form File lexBandeau_css toto : remplacer par un fileupload
        $getLexBandeau = $this->getVar('lex_bandeau');
        $lexBandeau = $getLexBandeau ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__params';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_PARAM_BANDEAU, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_PARAM_BANDEAU_UPLOADS, ".{$fileDirectory}/"), 'lex_bandeau', $lexBandeau, 1);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File lexBandeau: Upload new file
        if (true) {
        //if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'lex_bandeau', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('lex_bandeau', $lexBandeau));
        }
        $form->addElement($fileTray);
        //------------------------------------------
        // Form Text lexWeight
        $inpWeight = new \XoopsFormText(\_AM_LEXIQUE_PARAM_WEIGHT, 'lex_weight', 50, 255, $this->getVar('lex_weight'));
        $inpWeight->setDescription(_AM_LEXIQUE_PARAM_WEIGHT_DESC);
        $form->addElement($inpWeight);

/* est-ce utile dans cette version, utiliser plutot les permissions serait peut être plus judicieux
        // Form Text lexBin_menus
        $lexBin_menus = $this->isNew() ? '65535' : $this->getVar('lex_bin_menus');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_BIN_MENUS, 'lex_bin_menus', 20, 150, $lexBin_menus));
*/        

 
        // Form Text lexGroup_id_mail
        $groupList = $memberHandler->getGroupList();
        $lexGroup_id_mail = $this->isNew() ? '1' : $this->getVar('lex_group_id_mail');
        $inpGroupMail = new \XoopsFormSelect(\_AM_LEXIQUE_PARAM_GROUP_ID_MAIL, 'lex_group_id_mail', $lexGroup_id_mail);
        $inpGroupMail->addOptionArray($groupList);
        $inpGroupMail->setDescription(\_AM_LEXIQUE_PARAM_GROUP_ID_MAIL_DESC);
        $form->addElement($inpGroupMail);
        

        
        /*
        // Form Text lexSql_prefix
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_SQL_PREFIX, 'lex_sql_prefix', 50, 255, $this->getVar('lex_sql_prefix')));
        // Form Text lexCategory
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_CATEGORY, 'lex_category', 50, 255, $this->getVar('lex_category')));
        // Form Text lexIcon
        $lexIcon = $this->isNew() ? 'livre1.gif' : $this->getVar('lex_icon');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_ICON, 'lex_icon', 20, 150, $lexIcon));
        // Form Text lexIcon_width
        $lexIcon_width = $this->isNew() ? '1' : $this->getVar('lex_icon_width');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_ICON_WIDTH, 'lex_icon_width', 20, 150, $lexIcon_width));
        // Form Radio lexActif
        $lexActif = $this->isNew() ? 0 : $this->getVar('lex_actif');
        $lexActifSelect = new \XoopsFormRadio(\_AM_LEXIQUE_PARAM_ACTIF, 'lex_actif', $lexActif);
        $lexActifSelect->addOption('0', \_NONE);
        $lexActifSelect->addOption('1', \_AM_LEXIQUE_LIST_1);
        $lexActifSelect->addOption('2', \_AM_LEXIQUE_LIST_2);
        $lexActifSelect->addOption('3', \_AM_LEXIQUE_LIST_3);
        $form->addElement($lexActifSelect);
        // Form Radio lexDefault
        $lexDefault = $this->isNew() ? 0 : $this->getVar('lex_default');
        $lexDefaultSelect = new \XoopsFormRadio(\_AM_LEXIQUE_PARAM_DEFAULT, 'lex_default', $lexDefault);
        $lexDefaultSelect->addOption('0', \_NONE);
        $lexDefaultSelect->addOption('1', \_AM_LEXIQUE_LIST_1);
        $lexDefaultSelect->addOption('2', \_AM_LEXIQUE_LIST_2);
        $lexDefaultSelect->addOption('3', \_AM_LEXIQUE_LIST_3);
        $form->addElement($lexDefaultSelect);
        // Form Radio lexSeealso_mode
        $lexSeealso_mode = $this->isNew() ? 0 : $this->getVar('lex_seealso_mode');
        $lexSeealso_modeSelect = new \XoopsFormRadio(\_AM_LEXIQUE_PARAM_SEEALSO_MODE, 'lex_seealso_mode', $lexSeealso_mode);
        $lexSeealso_modeSelect->addOption('0', \_NONE);
        $lexSeealso_modeSelect->addOption('1', \_AM_LEXIQUE_LIST_1);
        $lexSeealso_modeSelect->addOption('2', \_AM_LEXIQUE_LIST_2);
        $lexSeealso_modeSelect->addOption('3', \_AM_LEXIQUE_LIST_3);
        $form->addElement($lexSeealso_modeSelect);
        // Form Radio lexButtons_position   JJDai pas forcément utile, boutons a placcer à droite du nom systématiquement, a voir plus tard
        $lexButtons_position = $this->isNew() ? 0 : $this->getVar('lex_buttons_position');
        $lexButtons_positionSelect = new \XoopsFormRadio(\_AM_LEXIQUE_PARAM_BUTTONS_POSITION, 'lex_buttons_position', $lexButtons_position);
        $lexButtons_positionSelect->addOption('0', \_NONE);
        $lexButtons_positionSelect->addOption('1', \_AM_LEXIQUE_LIST_1);
        $lexButtons_positionSelect->addOption('2', \_AM_LEXIQUE_LIST_2);
        $lexButtons_positionSelect->addOption('3', \_AM_LEXIQUE_LIST_3);
        $form->addElement($lexButtons_positionSelect);
        
        
        //========================================================
                lexique_insertBreak($form, _AM_LEXIQUE_BREAKLINE_LEXIQUE_NOTATION);
        //========================================================
        
        // Form Text lexNote_min
        $lexNote_min = $this->isNew() ? '0' : $this->getVar('lex_note_min');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NOTE_MIN, 'lex_note_min', 20, 150, $lexNote_min));
        // Form Text lexNote_max
        $lexNote_max = $this->isNew() ? '0' : $this->getVar('lex_note_max');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NOTE_MAX, 'lex_note_max', 20, 150, $lexNote_max));
        // Form File lexNote_img
        // Form File lexNote_img: Select Uploaded File 
        $getLexNote_img = $this->getVar('lex_note_img');
        $lexNote_img = $getLexNote_img ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__params';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_PARAM_NOTE_IMG, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_PARAM_NOTE_IMG_UPLOADS, ".{$fileDirectory}/"), 'lex_note_img', $lexNote_img, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File lexNote_img: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'lex_note_img', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('lex_note_img', $lexNote_img));
        }
        $form->addElement($fileTray);
        */
        //==============================================================================

        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_SELECTOR);
        //========================================================
        
        // Form Text lexSelector_caracters
        $lexSelector_caracters = $this->isNew() ? 'ABCDEFGHIJKLMNOPQRSTUVWXZ' : $this->getVar('lex_selector_caracters');
        $inpCaracters = new \XoopsFormText(\_AM_LEXIQUE_PARAM_SELECTOR_CARACTERS, 'lex_selector_caracters', 50, 150, $lexSelector_caracters);
        $inpCaracters->setDescription(_AM_LEXIQUE_PARAM_SELECTOR_CARACTERS_DESC);
        $form->addElement($inpCaracters);   
        
        // Form Text lexSelector_numerique
        $inpSelNum = new \XoopsFormText(\_AM_LEXIQUE_PARAM_SELECTOR_NUMERIQUE, 'lex_selector_numerique', 5, 12, $this->getVar('lex_selector_numerique'));
        $inpSelNum->setDescription(_AM_LEXIQUE_PARAM_SELECTOR_NUMERIQUE_DESC);
        $form->addElement($inpSelNum);   
             
        // Form Text lexSelector_other
        $lexSelector_other = $this->isNew() ? '#' : $this->getVar('lex_selector_other');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_SELECTOR_OTHER, 'lex_selector_other', 5, 12, $lexSelector_other));
        // Form Radio lexSelector_show_all
        $lexSelector_show_all = $this->isNew() ? 1 : $this->getVar('lex_selector_show_all');
        $lexSelector_show_allSelect = new \XoopsFormRadioYN(\_AM_LEXIQUE_PARAM_SELECTOR_SHOW_ALL, 'lex_selector_show_all', $lexSelector_show_all);
        $lexSelector_show_allSelect->setDescription(_AM_LEXIQUE_PARAM_SELECTOR_SHOW_ALL_DESC);
        $form->addElement($lexSelector_show_allSelect);
        // Form Text lexSelector_frames_delimitor
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_SELECTOR_FRAMES_DELIMITOR, 'lex_selector_frames_delimitor', 5, 12, $this->getVar('lex_selector_frames_delimitor')));
        // Form Text lexSelector_letters_separator
        $lexSelector_letters_separator = $this->isNew() ? '#|#' : $this->getVar('lex_selector_letters_separator');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_SELECTOR_LETTERS_SEPARATOR, 'lex_selector_letters_separator', 5, 12, $lexSelector_letters_separator));
        
        // Form Editor TextArea lexSelector_css_enabled
        $form->addElement(lexique_get_textarea_editor(_AM_LEXIQUE_PARAM_SELECTOR_CSS_ENABLED, 'lex_selector_css_enabled', $this->getVar('lex_selector_css_enabled', 'e')));
        // Form Editor TextArea lexSelector_css_selected
        $form->addElement(lexique_get_textarea_editor(_AM_LEXIQUE_PARAM_SELECTOR_CSS_SELECTED, 'lex_selector_css_selected', $this->getVar('lex_selector_css_selected', 'e')));        
        // Form Editor TextArea lexSelector_css_disabled
        $form->addElement(lexique_get_textarea_editor(_AM_LEXIQUE_PARAM_SELECTOR_CSS_DISABLED, 'lex_selector_css_disabled', $this->getVar('lex_selector_css_disabled', 'e')));
        
        
        // Form File lexBandeau
        // Form File lexBandeau: Select Uploaded File 

        // Form Text lexTerm_admin_pager
        $lexTerm_admin_pager = $this->isNew() ? '10' : $this->getVar('lex_term_admin_pager');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_TERM_ADMIN_PAGER, 'lex_term_admin_pager', 20, 150, $lexTerm_admin_pager));

        // Form Text lexTerm_user_pager
        $lexTerm_user_pager = $this->isNew() ? '10' : $this->getVar('lex_term_user_pager');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_TERM_USER_PAGER, 'lex_term_user_pager', 20, 150, $lexTerm_user_pager));

        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_TERMS_PARAMS);
        //========================================================
        // Form Text lexEditor
        $inpEditor = new \XoopsFormSelect(\_AM_LEXIQUE_PARAM_EDITOR, 'lex_editor', $this->getVar('lex_editor'));
        $inpEditor->setDescription(_AM_LEXIQUE_PARAM_EDITOR_DESC);
        $inpEditor->addOptionArray($editorHandler->getList());
        $form->addElement($inpEditor);
        
        // Form Radio lexPos_Image_1
        $lexPos_Image_1 = $this->isNew() ? 0 : $this->getVar('lex_pos_Image_1');
        $lexPos_Image_1Select = new \XoopsFormRadio(\_AM_LEXIQUE_PARAM_POS_IMAGE_1, 'lex_pos_Image_1', $lexPos_Image_1);
        $lexPos_Image_1Select->addOption('0', \_AM_LEXIQUE_POS_IMAGE_LETTRINE_LEFT);
        $lexPos_Image_1Select->addOption('1', \_AM_LEXIQUE_POS_IMAGE_LETTRINE_RIGHT);
        $lexPos_Image_1Select->addOption('2', \_AM_LEXIQUE_POS_IMAGE_CENTER);
        $form->addElement($lexPos_Image_1Select);

/*
remplacé par une recherche systématique dans le name, shordef, description et selon les parametres des propertys
        // Form Text lexBin_search
        $lexBin_search = $this->isNew() ? '65535' : $this->getVar('lex_bin_search');
        $inpSearch = new \xoopsFormCheckboxBin(_AM_LEXIQUE_PARAM_BIN_SEARCH, 'lex_bin_search', $lexBin_search);        

        //todo : ajouter ici la liste des propriété autorisant la rexcherche
        $inpSearch->addOption(1, _AM_LEXIQUE_PARAM_BIN_SEARCH_NAME);
        $inpSearch->addOption(2, _AM_LEXIQUE_PARAM_BIN_SEARCH_SHORT_DEF);
        $inpSearch->addOption(4, _AM_LEXIQUE_PARAM_BIN_SEARCH_DEFINITION);
        $form->addElement($inpSearch);

dans la version précédente cela permettai un affichage spécifique par groupe
pas vraiment utile un définitive, remplacé par les parmission des propriétés
        // Form Text lexBin_show
        $lexBin_show = $this->isNew() ? '65535' : $this->getVar('lex_bin_show');        
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_BIN_SHOW, 'lex_bin_show', 50, 255, $lexBin_show));
*/        
        
        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_OTHER_PARAMS);
        //========================================================

/*
        // Form File lexBandeau_css: Select Uploaded File 
        $getLexBandeau_css = $this->getVar('lex_bandeau_css');
        $lexBandeau_css = $getLexBandeau_css ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__params';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_PARAM_BANDEAU_CSS, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_PARAM_BANDEAU_CSS_UPLOADS, ".{$fileDirectory}/"), 'lex_bandeau_css', $lexBandeau_css, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File lexBandeau_css: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'lex_bandeau_css', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('lex_bandeau_css', $lexBandeau_css));
        }
        $form->addElement($fileTray);

        // Form File lexTerm_img_css
        // Form File lexTerm_img_css: Select Uploaded File 
        $getLexTerm_img_css = $this->getVar('lex_term_img_css');
        $lexTerm_img_css = $getLexTerm_img_css ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__params';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_PARAM_TERM_IMG_CSS, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_PARAM_TERM_IMG_CSS_UPLOADS, ".{$fileDirectory}/"), 'lex_term_img_css', $lexTerm_img_css, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File lexTerm_img_css: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'lex_term_img_css', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('lex_term_img_css', $lexTerm_img_css));
        }
        $form->addElement($fileTray);

*/        
        // Form Text lexTerms_visits
        $lexTerms_visits = $this->isNew() ? '0' : $this->getVar('lex_terms_visits');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_TERMS_VISITS, 'lex_terms_visits', 20, 150, $lexTerms_visits));
        // Form Text Date Select lexDate_creation
        $lexDate_creation = $this->isNew() ? \time() : $this->getVar('lex_date_creation');
        $form->addElement(new \XoopsFormDateTime(\_AM_LEXIQUE_PARAM_DATE_CREATION, 'lex_date_creation', '', $lexDate_creation));
        // Form Text Date Select lexDate_modification
        $lexDate_modification = $this->isNew() ? \time() : $this->getVar('lex_date_modification');
        $form->addElement(new \XoopsFormDateTime(\_AM_LEXIQUE_PARAM_DATE_MODIFICATION, 'lex_date_modification', '', $lexDate_modification));
        
        /*
        // Form Text lexNote_count
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NOTE_COUNT, 'lex_note_count', 50, 255, $this->getVar('lex_note_count')));
        // Form Text lexNote_sum
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NOTE_SUM, 'lex_note_sum', 50, 255, $this->getVar('lex_note_sum')));
        // Form Text lexNote_average
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PARAM_NOTE_AVERAGE, 'lex_note_average', 50, 255, $this->getVar('lex_note_average')));
        */
        
        
        
        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_PERMISSIONS);
        //========================================================
        // Permissions
        $groupList = $memberHandler->getGroupList();
        $grouppermHandler = \xoops_getHandler('groupperm');
        $fullList[] = \array_keys($groupList);
        if ($this->isNew()) {
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_APPROVE, 'groups_approve_lex__params[]', $fullList);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_SUBMIT, 'groups_submit_lex__params[]', $fullList);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_VIEW, 'groups_view_lex__params[]', $fullList);
        } else {
            $groupsIdsApprove = $grouppermHandler->getGroupIds('lexique_approve_lex__params', $this->getVar('lex_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsApprove[] = \array_values($groupsIdsApprove);
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_APPROVE, 'groups_approve_lex__params[]', $groupsIdsApprove);
            $groupsIdsSubmit = $grouppermHandler->getGroupIds('lexique_submit_lex__params', $this->getVar('lex_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsSubmit[] = \array_values($groupsIdsSubmit);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_SUBMIT, 'groups_submit_lex__params[]', $groupsIdsSubmit);
            $groupsIdsView = $grouppermHandler->getGroupIds('lexique_view_lex__params', $this->getVar('lex_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsView[] = \array_values($groupsIdsView);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_VIEW, 'groups_view_lex__params[]', $groupsIdsView);
        }
        // To Approve
        $groupsCanApproveCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanApproveCheckbox);
        // To Submit
        $groupsCanSubmitCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanSubmitCheckbox);
        // To View
        $groupsCanViewCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanViewCheckbox);
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesLex__params($keys = null, $format = null, $maxDepth = null)
    {
        $helper  = \XoopsModules\Lexique\Helper::getInstance();
        $utility = new \XoopsModules\Lexique\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']                          = $this->getVar('lex_id');
        $ret['sql_prefix']                  = $this->getVar('lex_sql_prefix');
        $ret['category']                    = $this->getVar('lex_category');
        $ret['name']                        = $this->getVar('lex_name');
        $ret['icon']                        = $this->getVar('lex_icon');
        $ret['icon_width']                  = $this->getVar('lex_icon_width');
        $ret['description']                 = $this->getVar('lex_description', 'e');
        $editorMaxchar = $helper->getConfig('editor_maxchar');
        $ret['description_short']           = $utility::truncateHtml($ret['description'], $editorMaxchar);
        $ret['actif']                       = $this->getVar('lex_actif');
        $ret['weight']                      = $this->getVar('lex_weight');
        $ret['default']                     = $this->getVar('lex_default');
        $ret['seealso_mode']                = $this->getVar('lex_seealso_mode');
        $ret['bin_menus']                   = $this->getVar('lex_bin_menus');
        $ret['buttons_position']            = $this->getVar('lex_buttons_position');
        $ret['group_id_mail']               = $this->getVar('lex_group_id_mail');
        $ret['bin_search']                  = $this->getVar('lex_bin_search');
        $ret['note_min']                    = $this->getVar('lex_note_min');
        $ret['note_max']                    = $this->getVar('lex_note_max');
        $ret['note_img']                    = $this->getVar('lex_note_img');
        $ret['selector_caracters']          = $this->getVar('lex_selector_caracters');
        $ret['selector_numerique']          = $this->getVar('lex_selector_numerique');
        $ret['selector_other']              = $this->getVar('lex_selector_other');
        $ret['selector_show_all']           = $this->getVar('lex_selector_show_all');
        $ret['selector_frames_delimitor']   = $this->getVar('lex_selector_frames_delimitor');
        $ret['selector_letters_separator']  = $this->getVar('lex_selector_letters_separator');
        $ret['selector_css_enabled']        = \strip_tags($this->getVar('lex_selector_css_enabled', 'e'));
        $ret['selector_css_enabled_short']  = $utility::truncateHtml($ret['selector_css_enabled'], $editorMaxchar);
        $ret['selector_css_selected']       = \strip_tags($this->getVar('lex_selector_css_selected', 'e'));
        $ret['selector_css_selected_short'] = $utility::truncateHtml($ret['selector_css_selected'], $editorMaxchar);
        $ret['selector_css_disabled']       = \strip_tags($this->getVar('lex_selector_css_disabled', 'e'));
        $ret['selector_css_disabled_short'] = $utility::truncateHtml($ret['selector_css_disabled'], $editorMaxchar);
        $ret['bandeau']                     = $this->getVar('lex_bandeau');
        $ret['bandeau_css']                 = $this->getVar('lex_bandeau_css');
        $ret['term_admin_pager']            = $this->getVar('lex_term_admin_pager');
        $ret['term_user_pager']             = $this->getVar('lex_term_user_pager');
        $ret['term_img_css']                = $this->getVar('lex_term_img_css');
        $ret['terms_visits']                = $this->getVar('lex_terms_visits');
        $ret['date_creation']               = \formatTimestamp($this->getVar('lex_date_creation'), 'm');
        $ret['date_modification']           = \formatTimestamp($this->getVar('lex_date_modification'), 'm');
        $ret['note_count']                  = $this->getVar('lex_note_count');
        $ret['note_sum']                    = $this->getVar('lex_note_sum');
        $ret['note_average']                = $this->getVar('lex_note_average');
        $ret['editor']                      = $this->getVar('lex_editor');
        $ret['pos_Image_1']                 = $this->getVar('lex_pos_Image_1');
        $ret['bin_show']                    = $this->getVar('lex_bin_show');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__params()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
