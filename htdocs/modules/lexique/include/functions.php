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
 
/**
 * Get the basix editor with goog width params
 *
 * @param  $caption
 * @param  $name
 * @param  $value
 * @param  $nbRows
 * @param  $width
 * @return XoopsFormTextArea
 */
function lexique_get_textarea_editor($caption, $name, $value, $nbRows=4, $width=300)
{    
    $inpEditor = new \XoopsFormTextArea($caption, $name, $value, $nbRows);
    $inpEditor->setExtra("style='width:{$width}px;'");
    return $inpEditor;
}

/**
 * Insert e new breakline in form
 *
 * @param  $form
 * @param  $caption
 * @param  $backcolor
 * @param  $color
 * @return void
 */
function lexique_insertBreak(&$form, $caption, $backcolor = 'blue', $color = 'white')
{         
    $breakLine = sprintf("<center><div style='background:%s;color:%s;'>%s</div></center>", $backcolor, $color,  $caption);
    $form->insertBreak($breakLine);
}

/**
 * Get the permissions ids
 *
 * @param  $permtype
 * @param  $dirname
 * @return mixed $itemIds
 */
function lexiqueGetMyItemIds($permtype, $dirname)
{
    global $xoopsUser;
    static $permissions = [];
    if (\is_array($permissions) && \array_key_exists($permtype, $permissions)) {
        return $permissions[$permtype];
    }
    $moduleHandler = \xoops_getHandler('module');
    $lexiqueModule = $moduleHandler->getByDirname($dirname);
    $groups = \is_object($xoopsUser) ? $xoopsUser->getGroups() : \XOOPS_GROUP_ANONYMOUS;
    $grouppermHandler = \xoops_getHandler('groupperm');
    $itemIds = $grouppermHandler->getItemIds($permtype, $groups, $lexiqueModule->getVar('mid'));
    return $itemIds;
}

/**
 * Add content as meta tag to template
 * @param $content
 * @return void
 */

function lexiqueMetaKeywords($content)
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content= $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if(isset($xoTheme) && \is_object($xoTheme)) {
        $xoTheme->addMeta( 'meta', 'keywords', \strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_keywords', \strip_tags($content));
    }
}

/**
 * Add content as meta description to template
 * @param $content
 * @return void
 */
 
function lexiqueMetaDescription($content)
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if(isset($xoTheme) && \is_object($xoTheme)) {
        $xoTheme->addMeta( 'meta', 'description', \strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_description', \strip_tags($content));
    }
}

/**
 * Rewrite all url
 *
 * @param string  $module  module name
 * @param array   $array   array
 * @param string  $type    type
 * @return null|string $type    string replacement for any blank case
 */
function lexique_RewriteUrl($module, $array, $type = 'content')
{
    $comment = '';
    $helper = \XoopsModules\Lexique\Helper::getInstance();
    $lex__valuesHandler = $helper->getHandler('lex__values');
    $lenght_id = $helper->getConfig('lenght_id');
    $rewrite_url = $helper->getConfig('rewrite_url');

    if (0 != $lenght_id) {
        $id = $array['content_id'];
        while (\strlen($id) < $lenght_id) {
            $id = '0' . $id;
        }
    } else {
        $id = $array['content_id'];
    }

    if (isset($array['topic_alias']) && $array['topic_alias']) {
        $topic_name = $array['topic_alias'];
    } else {
        $topic_name = lexique_Filter(xoops_getModuleOption('static_name', $module));
    }

    switch ($rewrite_url) {

        case 'none':
            if($topic_name) {
                 $topic_name = 'topic=' . $topic_name . '&amp;';
            }
            $rewrite_base = '/modules/';
            $page = 'page=' . $array['content_alias'];
            return \XOOPS_URL . $rewrite_base . $module . '/' . $type . '.php?' . $topic_name . 'id=' . $id . '&amp;' . $page . $comment;
            break;

        case 'rewrite':
            if($topic_name) {
                $topic_name .= '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if(xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type .= '/';
            $id .= '/';
            if ('content/' === $type) {
                $type = '';
            }
            if ('comment-edit/' === $type || 'comment-reply/' === $type || 'comment-delete/' === $type) {
                return \XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return \XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name  . $id . $page . $rewrite_ext;
            break;

         case 'short':
            if($topic_name) {
                $topic_name .= '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if(xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type .= '/';
            if ('content/' === $type) {
                $type = '';
            }
            if ('comment-edit/' === $type || 'comment-reply/' === $type || 'comment-delete/' === $type) {
                return \XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return \XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name . $page . $rewrite_ext;
            break;
    }
    return null;
}
/**
 * Replace all escape, character, ... for display a correct url
 *
 * @param string $url      string to transform
 * @param string $type     string replacement for any blank case
 * @return string $url
 */
function lexique_Filter($url, $type = '') {

    // Get regular expression from module setting. default setting is : `[^a-z0-9]`i
    $helper = \XoopsModules\Lexique\Helper::getInstance();
    $lex__valuesHandler = $helper->getHandler('lex__values');
    $regular_expression = $helper->getConfig('regular_expression');

    $url = \strip_tags($url);
    $url .= \preg_replace('`\[.*\]`U', '', $url);
    $url .= \preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $url);
    $url .= \htmlentities($url, ENT_COMPAT, 'utf-8');
    $url .= \preg_replace('`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', "\1", $url);
    $url .= \preg_replace([$regular_expression, '`[-]+`'], '-', $url);
    $url = ('' == $url) ? $type : \strtolower(\trim($url, '-'));
    return $url;
}

/**
 * Get the arr of type
 *
 * @param $typeId  0 = Lste des type / 1 = tableau de paramètre du type passé en paramètre 
 * @return array
 */
function lexiqueGetSeperatorsList()
{             
    return array( 0 => \_NONE,
     1 => \_AM_LEXIQUE_SEPARATORS_BEFORE,
     2 => \_AM_LEXIQUE_SEPARATORS_AFTER,
     3 => \_AM_LEXIQUE_SEPARATORS_BEFORE_AFTER);
}

/**
 * Get the arr of type
 *
 * @param $typeId  0 = Lste des type / 1 = tableau de paramètre du type passé en paramètre 
 * @return array
 */
function lexiqueGetTypePropertyArr_old($typeId = null, $dataArr = null)
{
/*
- 0 = Numérique :  [décimales=0, min=0, max=0]
- 1 = Chaine :  [longueur, css]
- 2 Texte :	 [lines]
- 3 = Date : [format, css]
- 4 = image : [width,]
*/
    if ($typeId){
        switch($typeId){
        case LEXIQUE_TYPE_NUM: 
            $arr = array('decimales' => 0, 'min' => 0 ,'max' => 0);
            break;
        case LEXIQUE_TYPE_TEXT: 
        case LEXIQUE_TYPE_RICHTEXT: 
            $arr = array('nblines' => 5);
            break;
        case LEXIQUE_TYPE_DATE: 
            $arr = array('formatdate' => 'YYYY-M-D');
            break;
        case LEXIQUE_TYPE_IMAGE: 
            $arr = array('size' => 8000, 'width'=> '300', 'css' => '');
            break;
        case LEXIQUE_TYPE_FILE: 
            $arr = array('size' => 8000);
            break;
        case LEXIQUE_TYPE_LIST: 
            $arr = array('listId' => 0);
            break;
        default:
        case LEXIQUE_TYPE_STRING: 
            $arr = array('lenstring' => 80);
            break;
        }
        //renvoie les valeur pa defaut si $dtaArr est null
       if ($dataArr)   {
            foreach($arr AS $key=>$value){
                if (isset($dataArr[$key])){
                    //recuperer les valeurs de la propriété
                   $arr[$key] = $dataArr[$key];
                }
            }
       }



    }else{
        $arr = array(LEXIQUE_TYPE_NUM=> _AM_LEXIQUE_TYPE_NUM, 
                     LEXIQUE_TYPE_STRING=> _AM_LEXIQUE_TYPE_STRING, 
                     LEXIQUE_TYPE_TEXT=> _AM_LEXIQUE_TYPE_TEXT, 
                     LEXIQUE_TYPE_RICHTEXT=> _AM_LEXIQUE_TYPE_RICHTEXT, 
                     LEXIQUE_TYPE_DATE=> _AM_LEXIQUE_TYPE_DATE, 
                     LEXIQUE_TYPE_IMAGE=> _AM_LEXIQUE_TYPE_IMAGE, 
                     LEXIQUE_TYPE_FILE=> _AM_LEXIQUE_TYPE_FILE,
                     LEXIQUE_TYPE_LIST=> _AM_LEXIQUE_TYPE_LIST);
    }
    return $arr;
}

/**********************************************
 *
 **********************************************/
function  lexique_get_css_separators($addEmpty=false){
global $helper;
    
    $fileName  = LEXIQUE_PATH . '/assets/css/separators.css';
    //if (is_null($fileName)) $fileName = JJD_PATH_CSS . "/style-item-color.css";
//echo "<hr>get_css_color - fileName : {$fileName}<hr>";    
    $content = file_get_contents ($fileName);
//echo $content . "<br>";
//echo "<br>{$fileName}<br>{$content}<br>";
    $tLines = explode("\n" , $content);
//echo "nbLines = " . count($tLines) . "<pre>" . print_r($tLines, true) . "</pre>";
//echo "nbLines = " . count($tLines) ;
//  echo "<pre>" . print_r($tLines, true) . "</pre>";

    //$tColors = array(XFORMS_DEFAULT => XFORMS_DEFAULT);
    $tColors = array();
    if ($addEmpty) $tColors[''] = '';
    foreach($tLines as $line){
      $line = trim($line);
      if(strlen($line)>0 && substr($line,0,3) == "hr."){
        $h = strpos($line, "{");
        $color = trim(substr($line,3, $h-4));        
        if (!array_key_exists($color, $tColors)){
            $tColors[$color] = $color;
        }
      }
    }

    return $tColors;
}
