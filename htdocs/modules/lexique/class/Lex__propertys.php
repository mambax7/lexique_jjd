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
 * Class Object Lex__propertys
 */
class Lex__propertys extends \XoopsObject
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
        $this->initVar('ppt_id', \XOBJ_DTYPE_INT);
        $this->initVar('ppt_list_id', \XOBJ_DTYPE_INT);
        $this->initVar('ppt_dtype_id', \XOBJ_DTYPE_INT);
        $this->initVar('ppt_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ppt_active', \XOBJ_DTYPE_INT);          
        $this->initVar('ppt_weight', \XOBJ_DTYPE_INT);
        $this->initVar('ppt_css', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ppt_is_criteria', \XOBJ_DTYPE_INT);
        $this->initVar('ppt_attributs', \XOBJ_DTYPE_TXTBOX);
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
    public function getNewInsertedIdLex__propertys()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__propertys_new($action = false)
    { global $lex__datatypesHandler, $lex__datatypesHandler, $lex__listsHandler;

        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_PROPERTY_ADD : \_AM_LEXIQUE_PROPERTY_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        // Form Text pptId
        //$form->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_PROPERTY_ID, $this->getVar('ppt_id')));
        $form->addElement(new \XoopsFormHidden('ppt_id', $this->getVar('ppt_id')));
        
        // Form Text pptName
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PROPERTY_NAME . " [#{$this->getVar('ppt_id')}]", 'ppt_name', 50, 255, $this->getVar('ppt_name')));
        
        // Form Text pptType_id
        $datatypeId  = ($this->getVar('ppt_dtype_id') == 0) ? 2 : $this->getVar('ppt_dtype_id') ;
        $inpTypeData = new \XoopsFormSelect(\_AM_LEXIQUE_PROPERTY_TYPE_LIBELLE, 'ppt_dtype_id', $datatypeId);
        $inpTypeData->addOptionArray(($lex__datatypesHandler->getList()));
        $form->addElement($inpTypeData);

        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save_primary'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }
    
    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__propertys($action = false)
    { global $lex__datatypesHandler, $lex__datatypesHandler, $lex__listsHandler;
    
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_PROPERTY_ADD : \_AM_LEXIQUE_PROPERTY_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        // Form Text pptId
        //$form->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_PROPERTY_ID, $this->getVar('ppt_id')));
        $form->addElement(new \XoopsFormHidden('ppt_id', $this->getVar('ppt_id')));
        
        // Form Text pptName
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PROPERTY_NAME . " [#{$this->getVar('ppt_id')}]", 'ppt_name', 50, 255, $this->getVar('ppt_name')));

        // Form Text pptType_id
        $datatypeId  = ($this->getVar('ppt_dtype_id') == 0) ? 1 : $this->getVar('ppt_dtype_id') ;
        if(true){
          $inpTypeData = new \XoopsFormSelect(\_AM_LEXIQUE_PROPERTY_TYPE_LIBELLE, 'ppt_dtype_id', $datatypeId);
          $inpTypeData->addOptionArray(($lex__datatypesHandler->getList()));
          //$inpTypeData->setExtra('disabled ');
          $form->addElement($inpTypeData);         
        }else{
          $form->addElement(new \XoopsFormLabel(_AM_LEXIQUE_PROPERTY_TYPE_LIBELLE, $lex__datatypesHandler->getList()[$datatypeId]));
          $form->addElement(new \XoopsFormHidden('ppt_dtype_id', $this->getVar('ppt_dtype_id')));         
        }        


         
         
       //---------------------------------------------------------------------------
        // Form Radio ppt_attributs
        // Form Text pptList_id
        //$form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PROPERTY_LIST_ID, 'ppt_list_id', 50, 255, $this->getVar('ppt_list_id')));
        //---------------------------------------------------------------------------
        
        // Form Radio ppt_css

        // Form Editor DhtmlTextArea termDefinition
//         $editorConfigs = [];
//         if ($isAdmin) {
//             $editor = $helper->getConfig('editor_admin');
//         } else {
//             $editor = $helper->getConfig('editor_user');
//         }
        $editor = 'textarea';
        $editorConfigs['name'] = 'ppt_css';
        $editorConfigs['value'] = $this->getVar('ppt_css', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $xfPptCss = new \XoopsFormEditor(\_AM_LEXIQUE_CSS, 'ppt_css', $editorConfigs);
        $form->addElement($xfPptCss);        
         $xfPptCss->setDescription(_AM_LEXIQUE_CSS_DESC);
        //---------------------------------------------------------------------------
        
        // Form Radio pptSeparators
        $pptSeparators = $this->isNew() ? 0 : $this->getVar('ppt_active');
        $pptSeparatorsSelect = new \XoopsFormRadioYN(\_AM_LEXIQUE_ACTIF, 'ppt_active', $pptSeparators);
        $form->addElement($pptSeparatorsSelect);
        
        // Form Text pptWeight
        $pptWeight = ($this->isNew() &&  $this->getVar('ppt_weight')==0) ? 99999 : $this->getVar('ppt_weight');
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_PROPERTY_WEIGHT, 'ppt_weight', 20, 150, $pptWeight));
        
        // Form Radio pptIs_criteria
        $pptIs_criteria = $this->isNew() ? 0 : $this->getVar('ppt_is_criteria');
        $pptIs_criteriaSelect = new \XoopsFormRadioyN(\_AM_LEXIQUE_PROPERTY_IS_CRITERIA, 'ppt_is_criteria', $pptIs_criteria);
        $form->addElement($pptIs_criteriaSelect);

        //========================================================
        lexique_insertBreak($form, \_AM_LEXIQUE_ATTRIBUTS);
        //========================================================
        $dataTypeObj = $lex__datatypesHandler->get($this->getVar('ppt_dtype_id'));
        //$form->insertBreak('<center><div style="background:green;color:white;">' . $dataTypeObj->getVar('dtype_attributs') . '</div></center>');   
        lexique_insertBreak($form, $dataTypeObj->getVar('dtype_attributs'), green, white);
        $tAtt = $dataTypeObj->toArrayLex__unserializeAttributs($this->getVar('ppt_attributs'));

        foreach($tAtt AS $key=>$val){
            $name = "ppt_attributs[{$key}]";
            $label = constant(strtoupper("_AM_LEXIQUE_DTYPE_{$key}"));
            
            switch($key) {
            case 'maxlen':
            case 'minlen':
            case 'max':
            case 'min':
            case 'inputnbcols':
            case 'inputwidth':
                 $xf = new \XoopsFormNumber($label, $name , 8, 4, $val);
                 $xf->setMinMax(0, 1000);
                 break;
            case 'nbfiles':
                 $xf = new \XoopsFormNumber($label, $name , 8, 4, $val);
                 $xf->setMinMax(1, 8);
                 break;
            case 'decimales':
                 $xf = new \XoopsFormNumber($label,  $name, 8, 4, $val);
                 $xf->setMinMax(0, 5);
                
                break;
            case 'nblines':
                 $xf = new \XoopsFormNumber($label,  $name, 8, 4, $val);
                 $xf->setMinMax(3, 12);
                break;
            case 'editor':
                //\xoops_load('xoopseditorHandler');
                //$editorHandler = XoopsEditorHandler::getInstance();
                include_once(XOOPS_ROOT_PATH . "\class\xoopseditor\xoopseditor.php");
                $editorHandler = new \XoopsEditorHandler();
                $xf = new \XoopsFormSelect($label, $name, $val);
                $xf->addOptionArray($editorHandler->getList());
                break;
             case 'format':
                $xf = new \XoopsFormText($label, $name, 80, 80, $val);
                 break;
            case 'showtime':

                $xf = new \XoopsFormRadio($label, $name, $val);
                $xf->addOption(LEXIQUE_SHOW_BOTH, _AM_LEXIQUE_DTYPE_SHOW_ALL);
                $xf->addOption(LEXIQUE_SHOW_DATE, _AM_LEXIQUE_DTYPE_SHOW_DATE);
                $xf->addOption(LEXIQUE_SHOW_TIME, _AM_LEXIQUE_DTYPE_SHOW_TIME);
               break;
            case 'list':
                $xf = new \XoopsFormSelect($label, $name, $val);
                $xf->addOptionArray($lex__listsHandler->getList());
                break;
            case 'size':
                $xf = new \XoopsFormText($label, $name, 12, 12, $val);
                break;
            case 'width':
                //$xf = new \XoopsFormText($label, $name, 20, 20, $val);
                $xf = new \XoopsFormNumber($label, $name , 8, 4, $val);
                $xf->setMinMax(0, 1920);
                break;
            case 'center':
                $xf = new \XoopsFormRadioYN($label, $name , $val);
                break;
            case 'stylecss':
                $hrId = 'separator-hr-' . rand(1000,9999);
                $cssArr = lexique_get_css_separators();
                $inpCss = new \XoopsFormSelect('', $name, $val, 5);
                $inpCss->addOptionArray($cssArr);
                $event =  "onchange=\"showClassSelected('{$hrId}','{$name}')\""; 
                $inpCss->setExtra($event);    //  "onchange='alert(\"zzzz\");'"
                
                
                $exHr = new \XoopsFormLabel("<div><hr id='{$hrId}' name='{$hrId}' class='blue-hr-style-two'></div>");                
                
                
              $xf = new \XoopsFormElementTray($label, '<br>');        
              $xf->addElement($inpCss);      
              $xf->addElement($exHr);      
    
                
                
                break;
            case 'image':
// imAges ICI
/*
  $k = "couverture_recto";
  $img = array();
  $names = array();
  for ($h=1; $h<=$xoopsModuleConfig['media_max_img']; $h++){
    $img[] = med_getFileMedia($t['idMedia'], 0, $h, _MED_FLD_COUVERTURE, _MED_FLD_THUMBS,1);
    $names[] = sprintf($xName,'image'.$h);
  }
  $xf[$k] = new XoopsFormLoadImages(_AM_MED_COUVERTURES, $names, $img, $xoopsModuleConfig['media_width_img']);      
  $form->addElement($xf[$k], false);  
 
*/            
                $fileDirectory ='/assets/images/separators';  
                $urlImg = LEXIQUE_SEPARATORS_URL;
                $imgId = 'separator-' . rand(1000,9999);
                
                $fileArray = \XoopsLists::getImgListAsArray(LEXIQUE_SEPARATORS_PATH );        
                $fileSelect = new \XoopsFormSelect('', $name, $val, 5); 
                //function showImgSelected(imgId, selectId, imgDir, extra, xoopsUrl) {
                $event =  "onchange=\"showImgSelected('{$imgId}', '{$name}', '', '', '{$urlImg}')\""; 
                $fileSelect->setExtra($event);    //  "onchange='alert(\"zzzz\");'"
                foreach ($fileArray as $file1) {
                    $fileSelect->addOption(($file1), $file1);
                }
                
                $folder = new \XoopsFormLabel(\sprintf(\_AM_LEXIQUE_TERM_IMAGE_1_UPLOADS, LEXIQUE_SEPARATORS_PATH . "/") );
                //$img = new \XoopsFormLabel("<img name='{$imgId}' id='{$imgId}' src='{$urlImg}/{$val}'>");
                $img = new \xoopsFormImage($labels , $imgId, $val, $urlImg, $title='', $alt='');   
                //$img->setCenter(isset()?:
                            
                $xf = new \XoopsFormElementTray($label, '<br>');        
                $xf->addElement($folder);      
                $xf->addElement($fileSelect);      
                $xf->addElement($img);    
                break;
            default:
                $xf = new \XoopsFormText($label, $name, 120, 120, $val);
                break;
            }
            $form->addElement($xf);
            unset($xf) ;
        }
        
        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_PERMISSIONS);
        //========================================================
        
        // Permissions
        $memberHandler = \xoops_getHandler('member');
        $groupList = $memberHandler->getGroupList();
        $grouppermHandler = \xoops_getHandler('groupperm');
        $fullList[] = \array_keys($groupList);
        if ($this->isNew()) {
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_APPROVE, 'groups_approve_lex__propertys[]', $fullList);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_SUBMIT, 'groups_submit_lex__propertys[]', $fullList);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_VIEW, 'groups_view_lex__propertys[]', $fullList);
        } else {
            $groupsIdsApprove = $grouppermHandler->getGroupIds('lexique_approve_lex__propertys', $this->getVar('ppt_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsApprove[] = \array_values($groupsIdsApprove);
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_APPROVE, 'groups_approve_lex__propertys[]', $groupsIdsApprove);
            $groupsIdsSubmit = $grouppermHandler->getGroupIds('lexique_submit_lex__propertys', $this->getVar('ppt_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsSubmit[] = \array_values($groupsIdsSubmit);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_SUBMIT, 'groups_submit_lex__propertys[]', $groupsIdsSubmit);
            $groupsIdsView = $grouppermHandler->getGroupIds('lexique_view_lex__propertys', $this->getVar('ppt_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsView[] = \array_values($groupsIdsView);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_LEXIQUE_PERMISSIONS_VIEW, 'groups_view_lex__propertys[]', $groupsIdsView);
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
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
//     public function getFormLex__propertys_attributs($typeId, $attributs, &$forms)
//     {
//         $attArr =  lexiqueGetTypePropertyArr($typeId, unserialize($attributs));
//         switch($typeData){ 
//         case LEXIQUE_TYPE_NUM: 
//             //$arr = array('decimales' => 0, 'min' => 0 ,'max' => 0);
//             $form->addElement(new \XoopsFormText('Decimale' , 'ppt_attributs[decimales]', 50, 255, $attArr['decimales']));
//             $form->addElement(new \XoopsFormText('min' , 'ppt_attributs[min]', 50, 255, $attArr['min']));
//             $form->addElement(new \XoopsFormText('max' , 'ppt_attributs[max]', 50, 255, $attArr['max']));
//                     
//             break;
//         case LEXIQUE_TYPE_TEXT: 
//         case LEXIQUE_TYPE_RICHTEXT: 
//             //$arr = array('nblines' => 5);
//             break;
//         case LEXIQUE_TYPE_DATE: 
//             //$arr = array('formatdate' => 'YYYY-M-D');
//             break;
//         case LEXIQUE_TYPE_IMAGE: 
//             //$arr = array('size' => 8000, 'width'=> '300');
//             break;
//         case LEXIQUE_TYPE_FILE: 
//             //$arr = array('size' => 8000);
//             break;
//         case LEXIQUE_TYPE_LIST: 
//             //$arr = array('listId' => 0);
//             break;
//         default:
//         case LEXIQUE_TYPE_STRING: 
//             $arr = array('lenstring' => 80 );
//             $form->addElement(new \XoopsFormText('lenstring' , 'ppt_attributs[lenstring]', 50, 255, $attArr['lenstring']));
//             
//             break;
//         }
// 
//     
//     
//     
//     }
    
    
    
    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesLex__propertys($keys = null, $format = null, $maxDepth = null)
    { global $lex__datatypesHandler;
        //$form->addElement(new \XoopsFormLabel(_AM_LEXIQUE_PROPERTY_TYPE_LIBELLE, $lex__datatypesHandler->getList()[$this->getVar('ppt_dtype_id')]));
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']            = $this->getVar('ppt_id');
        $ret['list_id']       = $this->getVar('ppt_list_id');
        $ret['dtype_id']      = $this->getVar('ppt_dtype_id');
        $ret['name']          = $this->getVar('ppt_name');
        $ret['active']        = $this->getVar('ppt_active');
        $ret['weight']        = $this->getVar('ppt_weight');
        $ret['css']           = $this->getVar('ppt_css');
        $ret['is_criteria']   = $this->getVar('ppt_is_criteria');
        $ret['attributs']     = $this->getVar('ppt_attributs');
        
        $ret['type_libelle']  = $lex__datatypesHandler->getList()[$ret['dtype_id']];

        
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__propertys()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
