<?php
/**
 * photowalls module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license             http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package	photowalls
 * @since		2.3.0
 * @author 	kris <http://www.xoofoo.org>
 * @version	$Id$
**/

include_once ("header.php");  

global $xoopsModule;
$dirname = $xoopsModule->getVar("dirname");		
$dirname = "mediatheque";
$module_info = $module_handler->get( $xoopsModule->getVar("mid") );
//include_once XOOPS_ROOT_PATH."/modules/" . $dirname . "/class/menu.php";
//-------------------------------------------------------------------


$p = array_merge($_POST, $_GET);
$op = ((isset($p['op'])) ? $p['op'] : 'list');
//$module = ((isset($p['module'])) ? $p['module'] : '');
$menu = ((isset($p['menu'])) ? $p['menu'] : '');
//jecho($p);exit;


 
/*******************************************************************
 *
 *******************************************************************/ 
function listConstantes(){
  $tr = print_r(get_defined_constants(true), true);
  //echo "Constantes :{$tr}<hr>";
  echo "Constantes :<pre style='text-align: left;'>{$tr}</pre><hr>";
  exit("Liste des constantes");
}       

/*******************************************************************
 *
 *******************************************************************/ 
function xModule(){
global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig, $GLOBALS, $xoopsTpl;

//     $tr = print_r($xoopsModule,true);
//     echo "xoopsModule :<pre>{$tr}<pre><hr>";
//     
//     $tr = print_r($xoopsModuleConfig,true);
//     echo "xoopsModuleConfig :<pre>{$tr}<pre><hr>";
//     
//     $tr = print_r($xoopsConfig,true);
//     echo "xoopsConfig :<pre>{$tr}<pre><hr>";
    
//     $tr = print_r($xoopsTpl->_tpl_vars['xoTheme']->template->_tpl_vars['xoops_themecss'],true);
//     echo "global :<pre>{$tr}<pre><hr>";
    
    $tr = print_r($GLOBALS,true);
    echo "global :<pre>{$tr}</pre><hr>";
    jexit;
}
/*******************************************************************
 *
 *******************************************************************/ 
function xModuleConfig(){
global $xoopsModuleConfig;

     $tr = print_r($xoopsModuleConfig,true);
     echo "xoopsModuleConfig :<pre>{$tr}<pre><hr>";
    jexit("moduleConfig");
}


/*******************************************************************
 *
 *******************************************************************/ 
//admin_traitement.php?op=updateCodeOptions
//jecho($p);exit;
    $msg = "";    
switch ($op){
  //---------------------------------------------

  case 'rebuild_requetes':
    $f = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar("dirname") . '/sql/querys2uninstall.sql';
    JJD\FSO\executeSqlFile($f);   
    
    $f = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar("dirname") . '/sql/querys2install.sql';
    JJD\FSO\executeSqlFile($f);   
    
    //exit;("Requetes=>execute");  
    $msg = "Requêtes reconstruites";
  redirect_header('index.php', 3, $msg);
  
    break;

 //---------------------------------------------
    
  case 'xModule':
    xModule();
    exit;
    break;
    
  case 'listConstantes':
    listConstantes();
    exit;
    break;
    
  case 'xoopsModuleConfig':
    xModuleConfig();
    exit;
    break;
    
  case 'phpinfo':
    phpinfo();
    exit;
    break;         
    
}
//jexit;
  redirect_header('index.php', 3, $msg);
  ///redirect_header('index.php', _MED_DELAI_RELANCE_TRAITEMENT, '');
?>
