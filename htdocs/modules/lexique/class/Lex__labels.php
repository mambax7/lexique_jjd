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
 * Class Object Lex__labels
 */
class Lex__labels extends \XoopsObject
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
        $this->initVar('lab_id', \XOBJ_DTYPE_INT);
        $this->initVar('lab_lex_id', \XOBJ_DTYPE_INT);
        $this->initVar('lab_code', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('lab_label', \XOBJ_DTYPE_TXTBOX);
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
    public function getNewInsertedIdLex__labels()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__labels($action = false)
    {
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_LABEL_ADD : \_AM_LEXIQUE_LABEL_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        // Form Text labId
        $form->addElement(new \XoopsFormHidden('lab_id', $this->getVar('lab_id')));        
        $form->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_LABEL_ID, $this->getVar('lab_id')));
        
        
        // Form Text labLex_id
        $labLex_id = $this->isNew() ? '0' : $this->getVar('lab_lex_id');
        $form->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_LABEL_LEX_ID, $labLex_id));
        $form->addElement(new \XoopsFormHidden('lab_lex_id', $labLex_id));
        
        
        // Form Text labCode
        if ($this->isNew()){
          $xfLabCode = new \XoopsFormText(\_AM_LEXIQUE_LABEL_CODE, 'lab_code', 50, 255, $this->getVar('lab_code'));
        }else{
          $xfLabCode = new \XoopsFormLabel(\_AM_LEXIQUE_LABEL_CODE, $this->getVar('lab_code'));
          $form->addElement(new \XoopsFormHidden('lab_code', $this->getVar('lab_code')));
        }
        $xfLabCode->setDescription(\_AM_LEXIQUE_LABEL_CODE_DESC);
        $form->addElement($xfLabCode);
        
        // Form Text labLabel
        $xflabLabel = new \XoopsFormText(\_AM_LEXIQUE_LABEL_LABEL, 'lab_label', 50, 255, $this->getVar('lab_label'));
        $xflabLabel->setDescription(\_AM_LEXIQUE_LABEL_LABEL_DESC);
        $form->addElement($xflabLabel);
        
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
    public function getValuesLex__labels($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']     = $this->getVar('lab_id');
        $ret['lex_id'] = $this->getVar('lab_lex_id');
        $ret['code']   = $this->getVar('lab_code');
        $ret['label']  = $this->getVar('lab_label');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__labels()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
