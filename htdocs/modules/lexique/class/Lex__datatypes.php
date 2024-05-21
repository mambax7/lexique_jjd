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
 * builddatatype module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

use XoopsModules\Lexique;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Lex__datatypes
 */
class Lex__datatypes extends \XoopsObject
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
        $this->initVar('dtype_id', \XOBJ_DTYPE_INT);
        $this->initVar('dtype_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('dtype_attributs', \XOBJ_DTYPE_TXTBOX);
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
    public function getNewInsertedIdLex__datatypes()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__datatypes($action = false)
    {
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_DATATYPE_ADD : \_AM_LEXIQUE_DATATYPE_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text dtypeName
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_DATATYPE_NAME, 'dtype_name', 50, 255, $this->getVar('dtype_name')), true);
        // Form Text dtypeAttributs
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_DATATYPE_ATTRIBUTS, 'dtype_attributs', 150, 255, $this->getVar('dtype_attributs')));
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
    public function getValuesLex__datatypes($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']        = $this->getVar('dtype_id');
        $ret['name']      = $this->getVar('dtype_name');
        $ret['attributs'] = $this->getVar('dtype_attributs');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__datatypes()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__unserializeAttributs($pptAtt = null)
    {
        switch($this->getVar('dtype_id')){
        case LEXIQUE_DTYPE_NUMBER:  //number
            $tTypes = array('decimales'=>0,'min'=>0,'max'=>0);
            break;
        case LEXIQUE_DTYPE_TEXT:  //text
            $tTypes = array('nblines'=>5,'inputnbcols'=>120,'inputwidth'=>400,'editor'=>'textarea');
            break;
        case LEXIQUE_DTYPE_DATETIME: // Date heure
            $tTypes = array('format'=>'d-m-Y H:i:s', 'showtime'=>0);
            break;
        case LEXIQUE_DTYPE_DATE: // Heure
            $tTypes = array('format'=>'d-m-Y');
            break;
        case LEXIQUE_DTYPE_IMAGE: // image
            $tTypes = array('size'=>8000,'nbfiles'=>1,'width'=>300);
            break;
        case LEXIQUE_DTYPE_FILE:  // Fichier
            $tTypes = array('size'=>8000,'nbfiles'=>1);
            break;
        case LEXIQUE_DTYPE_LIST:
            $tTypes = array('list'=>1);
            break;
        case LEXIQUE_DTYPE_SEPARATORHR:
            $tTypes = array('stylecss'=>'<hr>','width'=>0);
            break;
        case LEXIQUE_DTYPE_SEPARATORIMG:
            $tTypes = array('image'=>'separator-ligne-001','width'=>0,'center'=>1);
            break;
        case LEXIQUE_DTYPE_URL:
        case LEXIQUE_DTYPE_EMAIL:
        case LEXIQUE_DTYPE_STRING:  //string
        default;
            $tTypes = array('maxlen'=>80,'minlen'=>0);
            break;
        }
    //a garder au cas ou mais le champs attributs n'est pas une bonne optin en cas de mse à jor des attributs
    //$tTypes = unserialize(html_entity_decode( $this->getVar('dtype_attributs')));
        //----------------------------
       
       if($pptAtt) {
            $pptAtt = html_entity_decode( $pptAtt);
            $pptArr = unserialize($pptAtt);       //, ['allowed_classes' => true]  , ['max_depth' => 2]
            foreach($tTypes AS $key=>$value){
                if (isset($pptArr[$key])) $tTypes[$key] = $pptArr[$key];
            }
        }
        
        return $tTypes;

    }
}
