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

use XoopsModules\Lexique\Common;

require_once \dirname(__DIR__) . '/preloads/autoloader.php';
require __DIR__ . '/header.php';

// Template Index
$templateMain = 'lexique_admin_index.tpl';

// Count elements
$countLex__items = $lex__itemsHandler->getCount();
$countLex__labels = $lex__labelsHandler->getCount();
$countLex__lists = $lex__listsHandler->getCount();
$countLex__params = $lex__paramsHandler->getCount();
$countLex__propertys = $lex__propertysHandler->getCount();
$countLex__terms = $lex__termsHandler->getCount();
$countLex__values = $lex__valuesHandler->getCount();

// InfoBox Statistics
$adminObject->addInfoBox(\_AM_LEXIQUE_STATISTICS);
// Info elements
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__ITEMS . '</label>', $countLex__items));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__LABELS . '</label>', $countLex__labels));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__LISTS . '</label>', $countLex__lists));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__PARAMS . '</label>', $countLex__params));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__PROPERTYS . '</label>', $countLex__propertys));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__TERMS . '</label>', $countLex__terms));
$adminObject->addInfoBoxLine(\sprintf( '<label>' . \_AM_LEXIQUE_THEREARE_LEX__VALUES . '</label>', $countLex__values));

// ----------- InfoBox Tools ---------------------------------
$boxName  = \_AM_LEXIQUE_TOOLS;
$adminObject->addInfoBox($boxName);
      $traitaments = array(
        array('caption'=>'Global:', ),
        array('op'=>'rebuild_requetes',           'params'=>'', 'caption'=>'Reconstruction des requêtes de la base'),

        array('caption'=>'Info Xoops:'),
        array('op'=>'xModule',                    'params'=>'', 'caption'=>'Contenu de xoopsModule'),
        array('op'=>'xoopsModuleConfig',          'params'=>'', 'caption'=>'Contenu de xoopsModuleConfig'),
        array('op'=>'listConstantes',             'params'=>'', 'caption'=>'Liste des constantes'),
        array('op'=>'phpinfo',                    'params'=>'', 'caption'=>'phpinfo()')
        );        
      foreach ($traitaments as $t){
        if (isset($t['op'])){
          $url = "<a href='traitements.php?op={$t['op']}{$t['params']}'>{$t['caption']}</a>";
          $adminObject->addInfoBoxLine($url);  
        }else{
          $adminObject->addInfoBoxLine('');  
          $adminObject->addInfoBoxLine($t['caption']);  
        }  
      }
//--------------------------------------------------------------------




// Upload Folders
$configurator = new Common\Configurator();
if ($configurator->uploadFolders && \is_array($configurator->uploadFolders)) {
    foreach (\array_keys($configurator->uploadFolders) as $i) {
        $folder[] = $configurator->uploadFolders[$i];
    }
}
// Uploads Folders Created
foreach (\array_keys($folder) as $i) {
    $adminObject->addConfigBoxLine($folder[$i], 'folder');
    $adminObject->addConfigBoxLine([$folder[$i], '777'], 'chmod');
}

// Render Index
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('index.php'));
// Test Data
if ($helper->getConfig('displaySampleButton')) {
    \xoops_loadLanguage('admin/modulesadmin', 'system');
    require_once \dirname(__DIR__) . '/testdata/index.php';
    $adminObject->addItemButton(\constant('_CO_LEXIQUE_ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');
    $adminObject->addItemButton(\constant('_CO_LEXIQUE_SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');
//    $adminObject->addItemButton(\constant('_CO_LEXIQUE_EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');
    $adminObject->displayButton('left');
}
$GLOBALS['xoopsTpl']->assign('index', $adminObject->displayIndex());
// End Test Data
require __DIR__ . '/footer.php';
