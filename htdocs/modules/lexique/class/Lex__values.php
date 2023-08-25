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
 * Class Object Lex__values
 */
class Lex__values extends \XoopsObject
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
        $this->initVar('val_id', \XOBJ_DTYPE_INT);
        $this->initVar('val_lex_id', \XOBJ_DTYPE_INT);
        $this->initVar('val_ppt_id', \XOBJ_DTYPE_INT);
        $this->initVar('val_term_id', \XOBJ_DTYPE_INT);
        $this->initVar('val_value', \XOBJ_DTYPE_OTHER);
        $this->initVar('val_link', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('val_attributs', \XOBJ_DTYPE_TXTBOX);
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
    public function getNewInsertedIdLex__values()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__values($action = false)
    {
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_VALUE_ADD : \_AM_LEXIQUE_VALUE_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text valId
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_ID, 'val_id', 50, 255, $this->getVar('val_id')));
        // Form Text valLex_id
        $valLex_id = $this->isNew() ? '0' : $this->getVar('val_lex_id');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_LEX_ID, 'val_lex_id', 20, 150, $valLex_id));
        // Form Text valPpt_id
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_PPT_ID, 'val_ppt_id', 50, 255, $this->getVar('val_ppt_id')));
        // Form Text valTerm_id
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_TERM_ID, 'val_term_id', 50, 255, $this->getVar('val_term_id')));
        // Form Editor DhtmlTextArea valValue
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
        $editorConfigs['name'] = 'val_value';
        $editorConfigs['value'] = $this->getVar('val_value', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_AM_LEXIQUE_VALUE_VALUE, 'val_value', $editorConfigs));
        // Form Text valLink
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_LINK, 'val_link', 50, 255, $this->getVar('val_link')));
        // Form Text valAttributs
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_VALUE_ATTRIBUTS, 'val_attributs', 50, 255, $this->getVar('val_attributs')));
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
    public function getValuesLex__values($keys = null, $format = null, $maxDepth = null)
    {
        $helper  = \XoopsModules\Lexique\Helper::getInstance();
        $utility = new \XoopsModules\Lexique\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']          = $this->getVar('val_id');
        $ret['lex_id']      = $this->getVar('val_lex_id');
        $ret['ppt_id']      = $this->getVar('val_ppt_id');
        $ret['term_id']     = $this->getVar('val_term_id');
        $ret['value']       = $this->getVar('val_value', 'e');
        $editorMaxchar = $helper->getConfig('editor_maxchar');
        $ret['value_short'] = $utility::truncateHtml($ret['value'], $editorMaxchar);
        $ret['link']        = $this->getVar('val_link');
        $ret['attributs']   = $this->getVar('val_attributs');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__values()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
