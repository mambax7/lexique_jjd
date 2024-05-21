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

include_once(XOOPS_ROOT_PATH . '/modules/lexique/class/uploader.php');

//require __DIR__ . '/header.php';
// Get all request values
// $op     = Request::getCmd('op', 'list');
// $termId = Request::getInt('term_id');
// $start  = Request::getInt('start');
// $limit  = Request::getInt('limit', $helper->getConfig('adminpager'));
// $GLOBALS['xoopsTpl']->assign('start', $start);
// $GLOBALS['xoopsTpl']->assign('limit', $limit);

// $context = "&start={$start}&limit={$limit}";
echoArray($_POST);
echoArray($_FILES, "<hr>===== _FILES =====<hr>");

/*
@ $pptvalSubmited array _post submitted
@ $keyRoot : string, clé principale dans $_FILES 
             peut prendre deux valeur 'lex_images' ou 'lex_files'
*/
function retraitement_de_files(&$pptvalSubmited, $keyRoot = 'lex_images'){
//Transforme $_FILES en  tableau associaif par fichier   
$filsArr = array();
foreach ($_FILES[$keyRoot] AS $att=>$pptIdArr) {
    foreach ($pptIdArr AS $pptId=>$valuesArr) { 
        foreach ($valuesArr AS $item=>$indexArr) { 
            foreach ($indexArr AS $index=>$v) { 
                $key = "f-{$pptId}-{$index}";    
                $filsArr[$key][$att] = $v; 
                $pptvalSubmited[$pptId]['files'][$key][$att] = $v; 
            }
        }

    } 
}   
//$pptvalSubmited []['files']


}



function save_values($termId){
global $lex__propertysHandler, $lex__valuesHandler;
        //**** enregistrement des valeurs des propriétés ***************
        $pptvalSubmited = Request::getArray('pptval');
        retraitement_de_files($pptvalSubmited, 'lex_images');
        retraitement_de_files($pptvalSubmited, 'lex_files');
echoArray($pptvalSubmited, "========= resultat ==================");


        
        $lex__propertysAll = $lex__propertysHandler->getAllLex__propertys();

        foreach ($pptvalSubmited AS $pptId=>$arr){
            $valId = $arr['val_id']; 
            if($valId > 0){
                $lex__valuesObj = $lex__valuesHandler->get($valId);
            }else{
                $lex__valuesObj = $lex__valuesHandler->create();
                $lex__valuesObj->setVar('val_lex_id', Request::getInt('term_lex_id'));
                $lex__valuesObj->setVar('val_ppt_id', $pptId);
                $lex__valuesObj->setVar('val_term_id', $termId);
            }   
          //$lex__valuesObj->setVar('val_link', Request::getString('val_link'));
          //$lex__valuesObj->setVar('val_attributs', Request::getString('val_attributs'));
          
        switch($lex__propertysAll[$pptId]->getVar('ppt_dtype_id')){
        case LEXIQUE_DTYPE_DATETIME: 
            $lex__valuesObj->setVar('val_value', JJD\getSqlDate($arr['value'])) ;
            break;
            
        case LEXIQUE_DTYPE_FILE: 
            //ajouter la suppression des fichier 'name = delete_file'       
        case LEXIQUE_DTYPE_IMAGE: 
            $imgPath = "/uploads/lexique";
            if(isset($arr['delete_img'])){
            //echoArray($arr['delete_img'],"===== fichier à supprimer");
                $lgRoot = strlen(XOOPS_URL . $imgPath);
                $img2delete = array();
                foreach($arr['delete_img'] AS $f=>$ok){
                
                    $name = substr($f,$lgRoot);
                echo  "===>lgRoot = {$lgRoot}<br>{$f}<br>{$name}<br>";
                    $img2delete[] = $name;
                    unlink(XOOPS_ROOT_PATH . $imgPath . $name);
                }
            echoArray($img2delete,"===== fichier à supprimer");
            }
            $uploader = new FileUploader(null, null, false,"valId-{$valId}");  
            $uploader->setPath($imgPath); 
            $uploader->setFolder("zzz");   
            $filesList = array();   
            foreach ($arr['files'] AS $key=>$fileArr) {      
                if($uploader->move_upload($fileArr, $newName) == 0){
                    echo "===> copie de newName = {$newName}<br>"; 
                    $filesList[] = $newName; 
                }else{
                    echo "===> error = {$uploader->getErrorLib()} ===> {$newName}<br>";
                }
            }
            //supression des images a retirer
            //$img2delete
            
            $keepFiles = ($lex__valuesObj->getVar('val_value'))  ? explode("\n", $lex__valuesObj->getVar('val_value')) : array();
            if(is_array($keepFiles) && is_array($img2delete))
                $keepFiles = array_diff($keepFiles , $img2delete);
            $filesList  = array_unique(array_merge($filesList,$keepFiles));
            $lex__valuesObj->setVar('val_value', implode("\n", $filesList));
// SELECT * FROM `x2511_lexique_lex__values` WHERE `val_term_id`=1 AND `val_ppt_id`=121;  
          
            break;
            
  
            break;
            
        //sur ces deux proprietes il n'y a rien a sauvegzrder
        case LEXIQUE_DTYPE_SEPARATORHR:
        case LEXIQUE_DTYPE_SEPARATORIMG:
            break;
            
        case LEXIQUE_DTYPE_DATE: 
        case LEXIQUE_DTYPE_NUMBER: 
        case LEXIQUE_DTYPE_TEXT: 
        case LEXIQUE_DTYPE_LIST:
        case LEXIQUE_DTYPE_URL:
        case LEXIQUE_DTYPE_EMAIL:
        case LEXIQUE_DTYPE_STRING:  
        default;
            $lex__valuesObj->setVar('val_value', $arr['value']);
            break;
        }
          
          $resultVal = $lex__valuesHandler->insert($lex__valuesObj);
        }

// DELETE FROM `x2511_lexique_lex__values` WHERE `val_term_id`=0;  


}
// ======================================================================



        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('lex__terms.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($termId > 0) {
            $lex__termsObj = $lex__termsHandler->get($termId);
        } else {
            $lex__termsObj = $lex__termsHandler->create();
        }
        // Set Vars
        $uploaderErrors = '';
        $lex__termsObj->setVar('term_lex_id', Request::getInt('term_lex_id'));
        $lex__termsObj->setVar('term_letter', Request::getString('term_letter'));
        $lex__termsObj->setVar('term_letter', strtoupper(\JJD\enleve_accents(Request::getString('term_name'))));
        $lex__termsObj->setVar('term_name', Request::getString('term_name'));
        $lex__termsObj->setVar('term_short_def', Request::getString('term_short_def'));
        // Set Var term_image_1
        /*   ============== sauvegarde des images principales =====================
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
        */
        
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
        $result = $lex__termsHandler->insert($lex__termsObj);
        if ($termId==0) $termId = $lex__termsObj->getNewInsertedIdLex__terms();
        
        //==============================================
        save_values($termId) ;
        //==============================================
       exit;
        if ($result) {
            if ('' !== $uploaderErrors) {
                \redirect_header('lex__terms.php?op=edit&term_id=' . $termId, 5, $uploaderErrors);
            } else {
                \redirect_header('lex__terms.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_LEXIQUE_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $lex__termsObj->getHtmlErrors());
        $form = $lex__termsObj->getFormLex__terms();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());


