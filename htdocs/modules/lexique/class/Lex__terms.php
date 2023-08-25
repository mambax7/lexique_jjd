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
 * Class Object Lex__terms
 */
class Lex__terms extends \XoopsObject
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
        $this->initVar('term_id', \XOBJ_DTYPE_INT);
        $this->initVar('term_lex_id', \XOBJ_DTYPE_INT);
        $this->initVar('term_letter', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_short_def', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_image_1', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_image_2', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_image_3', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_definition', \XOBJ_DTYPE_OTHER);
        $this->initVar('term_seealso', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_seealso_list', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_state', \XOBJ_DTYPE_INT);
        $this->initVar('term_visits', \XOBJ_DTYPE_INT);
        $this->initVar('term_user_creation', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('term_date_creation', \XOBJ_DTYPE_LTIME);
        $this->initVar('term_date_modification', \XOBJ_DTYPE_LTIME);
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
    public function getNewInsertedIdLex__terms()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormLex__terms($action = false)
    {
    global $lex__itemsHandler;
        $helper = \XoopsModules\Lexique\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        //$isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        
        // Title
        $title = $this->isNew() ? \_AM_LEXIQUE_TERM_ADD : \_AM_LEXIQUE_TERM_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');  
        //----------------------------------------------------
        // Form Text termId
        $termLex_id = $this->isNew() ? '1' : $this->getVar('term_lex_id');
        $infoId = ($isAdmin)  ? sprintf(" <span style='color:blue;font-weight: normal;'>[#%s / #%s / @%s]</span>",$this->getVar('term_lex_id'),$this->getVar('term_id'),$this->getVar('term_letter')) : '';
        
        $form->addElement(new \XoopsFormHidden('term_id', $this->getVar('term_id')));
        $form->addElement(new \XoopsFormHidden('term_lex_id', $this->getVar('term_lex_id')));
        $form->addElement(new \XoopsFormHidden('term_letter', $this->getVar('term_letter')));
        
        // Form Text term_name
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_TERM_NAME . $infoId, 'term_name', 50, 255, $this->getVar('term_name')));
        
        // Form Text termShort_def
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_TERM_SHORT_DEF, 'term_short_def', 50, 255, $this->getVar('term_short_def')));
        
        // Form Editor DhtmlTextArea termDefinition
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
        $editorConfigs['name'] = 'term_definition';
        $editorConfigs['value'] = $this->getVar('term_definition', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_AM_LEXIQUE_TERM_DEFINITION, 'term_definition', $editorConfigs));
        
        // ----------------------------------------------/
        $nbImg = 3;
        $name = "term_images[%s]"; 
        $nameArr = array(); 
        
        for ($h=0; $h < $nbImg ; $h++){
          $img = $this->getVar("term_image_{h}");
          $imgArr[$h] = ($img) ? LEXIQUE_UPLOAD_URL . $img : '';
          $nameArr[$h] = sprintf($name, $h);
        }
        $xf = new \XoopsFormLoadImages(_AM_LEXIQUE_TERM_IMAGE_1, $nameArr, $imgArr, 150, 8000000);    
              //$xf->setDeleteName("{$nameMain}[delete_img]");  
        $form->addElement($xf);
        /*
        echoArray($imgArr);        
        echoArray($nameArr);        
        */       
         
     
        // Form Text termSeealso
        $inpSeeAlso = lexique_get_textarea_editor(_AM_LEXIQUE_TERM_SEEALSO, 'term_seealso', $this->getVar('term_seealso'),3,800);
        $inpSeeAlso->setDescription(_AM_LEXIQUE_TERM_SEEALSO_DESC);
        $form->addElement($inpSeeAlso);

        // ======================================================================
/*
        // Form File termImage_1
        // Form File termImage_1: Select Uploaded File 
        $getTermImage_1 = $this->getVar('term_image_1');
        $termImage_1 = $getTermImage_1 ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__terms';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_TERM_IMAGE_1, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_TERM_IMAGE_1_UPLOADS, ".{$fileDirectory}/"), 'term_image_1', $termImage_1, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File termImage_1: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'term_image_1', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('term_image_1', $termImage_1));
        }
        $form->addElement($fileTray);
        // Form File termImage_2
        // Form File termImage_2: Select Uploaded File 
        $getTermImage_2 = $this->getVar('term_image_2');
        $termImage_2 = $getTermImage_2 ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__terms';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_TERM_IMAGE_2, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_TERM_IMAGE_2_UPLOADS, ".{$fileDirectory}/"), 'term_image_2', $termImage_2, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File termImage_2: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'term_image_2', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('term_image_2', $termImage_2));
        }
        $form->addElement($fileTray);
        // Form File termImage_3
        // Form File termImage_3: Select Uploaded File 
        $getTermImage_3 = $this->getVar('term_image_3');
        $termImage_3 = $getTermImage_3 ?: 'blank.gif';
        $fileDirectory = '/uploads/lexique/files/lex__terms';
        $fileTray = new \XoopsFormElementTray(\_AM_LEXIQUE_TERM_IMAGE_3, '<br>');
        $fileSelect = new \XoopsFormSelect(\sprintf(\_AM_LEXIQUE_TERM_IMAGE_3_UPLOADS, ".{$fileDirectory}/"), 'term_image_3', $termImage_3, 5);
        $fileArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $fileDirectory );
        foreach ($fileArray as $file1) {
            $fileSelect->addOption(($file1), $file1);
        }
        $fileTray->addElement($fileSelect, false);
        // Form File termImage_3: Upload new file
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_file');
            $fileTray->addElement(new \XoopsFormFile('<br>' . \_AM_LEXIQUE_FORM_UPLOAD_NEW, 'term_image_3', $maxsize));
            $fileTray->addElement(new \XoopsFormLabel(\_AM_LEXIQUE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB));
        } else {
            $fileTray->addElement(new \XoopsFormHidden('term_image_3', $termImage_3));
        }
        $form->addElement($fileTray);
        
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_TERM_SEEALSO_LIST, 'term_seealso_list', 50, 255, $this->getVar('term_seealso_list')));
*/
        // Form Text termSeealso_list
        
        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_PROPERTYS_ADDONS);
        //========================================================
        $this->getForm_propertys($form);
        
        //========================================================
        lexique_insertBreak($form, _AM_LEXIQUE_OTHER_PARAMS);
        //========================================================
        
        //---------------------------------------------------------
        // Form Radio termState
        $termState = $this->isNew() ? 0 : $this->getVar('term_state');
        $termStateSelect = new \XoopsFormRadio(\_AM_LEXIQUE_TERM_STATE, 'term_state', $termState);
        $termStateSelect->addOption('0', \_NONE);
        $termStateSelect->addOption('1', \_AM_LEXIQUE_LIST_1);
        $termStateSelect->addOption('2', \_AM_LEXIQUE_LIST_2);
        $termStateSelect->addOption('3', \_AM_LEXIQUE_LIST_3);
        $form->addElement($termStateSelect);
        // Form Text termVisits
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_TERM_VISITS, 'term_visits', 50, 255, $this->getVar('term_visits')));
        // Form Text termUser_creation
        $form->addElement(new \XoopsFormText(\_AM_LEXIQUE_TERM_USER_CREATION, 'term_user_creation', 50, 255, $this->getVar('term_user_creation')));
        // Form Text Date Select termDate_creation
        $termDate_creation = $this->isNew() ? \time() : $this->getVar('term_date_creation');
        $form->addElement(new \XoopsFormDateTime(\_AM_LEXIQUE_TERM_DATE_CREATION, 'term_date_creation', '', $termDate_creation));
        // Form Text Date Select termDate_modification
        $termDate_modification = $this->isNew() ? \time() : $this->getVar('term_date_modification');
        $form->addElement(new \XoopsFormDateTime(\_AM_LEXIQUE_TERM_DATE_MODIFICATION, 'term_date_modification', '', $termDate_modification));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * add form of propertys of term
     */
    public function getForm_propertys(&$form)  {
    global $lex__itemsHandler;
/*  ex de tableau pour ppt
    [ppt] => Array
        (
            [108] => Array
                (
                    [ppt_id] => 108
                    [name] => Longueur (en cm.)
                    [dtype_id] => 2
                    [type_name] => NUMBER
                    [active] => 1
                    [weight] => 20
                    [css] => 
                    [is_criteria] => 1
                    [attributs] => a:3:{s:9:"decimales";s:1:"2";s:3:"min";s:1:"0";s:3:"max";s:2:"30";}
                    [value] => Array
                        (
                            [val_id] => 4
                            [val_lex_id] => 1
                            [val_ppt_id] => 108
                            [val_term_id] => 1
                            [val_value] => 5
                            [val_link] => 
                            [val_attributs] => 
                        )

                )
*/
        $pptVals = $this->get_propertys_values();
        $xf = array();
//                exit ("============== ICI ==========================");
        foreach ($pptVals AS $pptId=>$ppt) {
            $valId = (isset($ppt['value']['val_id'] )) ? $ppt['value']['val_id']  : 0;
            $val = (isset($ppt['value'])) ? $ppt['value']['val_value'] : null;
            $att = unserialize($ppt['attributs']);
            $label = "{$ppt['name']} <span style='color:blue;font-weight: normal;'>[#{$pptId}-{$valId}]</span>" ;
            $nameMain = "pptval[{$ppt['ppt_id']}]";         
            
            $xf = new \XoopsFormHidden($nameMain . "[val_id]", ($ppt['value']['val_id']) ? ($ppt['value']['val_id']) : 0);
            $form->addElement($xf);   
            unset($xf);
            $name = "pptval[{$ppt['ppt_id']}][value]";
            //$xf = new \XoopsFormHidden($name, $valId  );
            //$form->addElement($xf);
                
                
                            
//             $xf = new \XoopsFormlabel('val_id', $valId);
//             $form->addElement($xf);
            
            switch($ppt['dtype_id']){
            case LEXIQUE_DTYPE_NUMBER:
                 if($att['min'] != 0 || $att['max'] != 0){
                    $xf = new \XoopsFormNumber($label, $name , 8, 4, intval($val));
                    $xf->setMinMax($att['min'] , $att['max']);
                 }else{
                    $xf = new \XoopsFormText($label, $name, 30, 30, intval($val));
                 }
                break;
/*
*/                
            case LEXIQUE_DTYPE_TEXT:
                $editorConfigs = [];
                $editorConfigs['name'] = $name;
                $editorConfigs['value'] = $val;
                $editorConfigs['rows'] = 5;
                $editorConfigs['cols'] = 40;
                $editorConfigs['width'] = '100%';
                $editorConfigs['height'] = '400px';
                $editorConfigs['editor'] = $att['editor'];
                $xf = new \XoopsFormEditor($label, $name, $editorConfigs);
                break;
                
            case LEXIQUE_DTYPE_DATETIME:
                $dateValue =  ($val) ? strtotime($val) : time();
                //$dateValue = strtotime($val);
                $xf = new \XoopsFormDateTime($label, $name, 15, $dateValue, $att['showtime']);
                break;
                
            case LEXIQUE_DTYPE_DATE: //faire une liste pour les heures
                $dateValue =  ($val) ? strtotime($val) : time();
                //$xf = new \XoopsFormDateTime($label, $name, 15, $val, 2);
                $xf = new \XoopsFormTextDateSelect($label, $name, 15, $dateValue);
//     const SHOW_BOTH = 1;
//     const SHOW_DATE = 0;
//     const SHOW_TIME = 2;
                break;
                
                
                
            case LEXIQUE_DTYPE_IMAGE:
/*
// imAges ICI
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
              $imgArr = ($val) ? explode("\n", $val) : array(); 
              $nbImg = $att['nbfiles'];
              $nameArr = array(); 
              $name = "lex_images[{$ppt['ppt_id']}][value]"; 
              for ($h=0; $h < $nbImg ; $h++){
                $imgArr[$h] = LEXIQUE_UPLOAD_URL . $imgArr[$h]; //med_getFileMedia($t['idMedia'], 0, $h, _MED_FLD_COUVERTURE, _MED_FLD_THUMBS,1);
                $nameArr[$h] = "{$name}[{$h}]";
              }
              $xf = new \XoopsFormLoadImages($label, $nameArr, $imgArr, 150, 8000000);    
              //$xf->setDeleteName("{$nameMain}[delete_img]");  
echoArray($imgArr);        
echoArray($nameArr);        
                  
//                unset($imgArr);
//                unset($nameArr); 
                
                
                
                //$xf = new \XoopsFormLabel($label, 'A faire');
                break;
                
            case LEXIQUE_DTYPE_FILE:  
                $filesArr = ($val) ? explode("\n", $val) : array(); 
                $nbFiles = $att['nbfiles'];
                $name = "lex_files[{$ppt['ppt_id']}][value]"; 
                for ($h=1; $h<=$nbFiles ; $h++){
                  $filesArr[] = ''; //med_getFileMedia($t['idMedia'], 0, $h, _MED_FLD_COUVERTURE, _MED_FLD_THUMBS,1);
                  $nameArr[] = "{$name}[{$h}]";
                }
                $xf = new \XoopsFormLoadFiles($label, $nameArr, $filesArr);      
                //$xf->setDeleteName("{$nameMain}[delete_fils]");  
                //$xf = new \XoopsFormLabel($label, 'A faire');
                break;
                
                
                
            case LEXIQUE_DTYPE_LIST:
                 $xf = new \XoopsFormSelect($label, $name, $val, 1); 
                 $criteria = new \CriteriaCompo();
                 $criteria->add(new \Criteria('item_list_id', $att['list'],'='));
                 $items = $lex__itemsHandler->getList($criteria);
                 foreach($items AS $key=>$item)
                    $xf->addOption($item, $item);              
                break;
            case LEXIQUE_DTYPE_SEPARATORHR:
                $label = _AM_LEXIQUE_SEPARATOR . " <span style='color:blue;font-weight: normal;'>[#{$pptId}-{$valId}]</span>" ;
                $style= ($att['width'] > 0) ? "style='width:{$att['width']}px;'": '';
                $hr = "<hr class='{$att['stylecss']}' $style>";
                $xf = new \XoopsFormLabel($label, $hr);
                break;
            case LEXIQUE_DTYPE_SEPARATORIMG:
                $label = _AM_LEXIQUE_SEPARATOR . " <span style='color:blue;font-weight: normal;'>[#{$pptId}-{$valId}]</span>" ;
                $xf = new \xoopsFormImage($label , $name, $att['image'], LEXIQUE_SEPARATORS_URL);
                $xf->setWidth($att['width']);
                $xf->setCenter($att['center']);
                break;
                
            case LEXIQUE_DTYPE_STRING:
            case LEXIQUE_DTYPE_URL:
            case LEXIQUE_DTYPE_EMAIL:
            default:
                $xf = new \XoopsFormText($label, $name, 50, 255, $val);
                break;
            }
            $form->addElement($xf);
            unset ($xf);
            
        }    
    }
    
    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesLex__terms($keys = null, $format = null, $maxDepth = null)
    {
    global $xoopsDB, $lex__propertysHandler;
    
        $helper  = \XoopsModules\Lexique\Helper::getInstance();
        $utility = new \XoopsModules\Lexique\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']                = $this->getVar('term_id');
        $ret['lex_id']            = $this->getVar('term_lex_id');
        $ret['letter']            = $this->getVar('term_letter');
        $ret['name']              = $this->getVar('term_name');
        $ret['short_def']         = $this->getVar('term_short_def');
        $ret['image_1']           = $this->getVar('term_image_1');
        $ret['image_2']           = $this->getVar('term_image_2');
        $ret['image_3']           = $this->getVar('term_image_3');
        $ret['definition']        = $this->getVar('term_definition', 'e');
        $editorMaxchar = $helper->getConfig('editor_maxchar');
        $ret['definition_short']  = $utility::truncateHtml($ret['definition'], $editorMaxchar);
        $ret['seealso']           = $this->getVar('term_seealso');
        $ret['seealso_list']      = $this->getVar('term_seealso_list');
        $ret['state']             = $this->getVar('term_state');
        $ret['visits']            = $this->getVar('term_visits');
        $ret['user_creation']     = $this->getVar('term_user_creation');
        $ret['date_creation']     = \formatTimestamp($this->getVar('term_date_creation'), 'm');
        $ret['date_modification'] = \formatTimestamp($this->getVar('term_date_modification'), 'm');
        //--------------------------------------------------------------------

        $ret['ppt'] = $this->get_propertys_values();
        //echo "<hr><pre>" . print_r($ret ,true) . "</pre><hr>";
        return $ret;
    }

    /**
     * Returns an array representation of the values of the term
     *
     * @return array
     */
    public function get_propertys_values()
    {
    global $xoopsDB, $lex__propertysHandler;
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('ppt_active',1,'=')) ;
        $allppt = $lex__propertysHandler->getAllLex__propertysArr(1);
        //echo "<hr>allppt<pre>" . print_r($allppt ,true) . "</pre><hr>";

        $sql = "SELECT * FROM "   . $xoopsDB->prefix('lexique_lex__values')
             . " WHERE val_term_id = {$this->getVar('term_id')} ;";
        $result = $xoopsDB->query($sql);
        if($result){
          //echo "<hr>===>{$sql}<hr>";
          while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
              if (isset($allppt[$myrow['val_ppt_id']])){
                  $allppt[$myrow['val_ppt_id']]['value'] = $myrow ;
              }
          }
        }

        //echoArray($allppt);
        return $allppt;
    }
    
    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLex__terms()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
