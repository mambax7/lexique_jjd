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

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);
// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_LEXIQUE_NAME,
    'version'             => '3.0.0',
    'description'         => \_MI_LEXIQUE_DESC,
    'author'              => 'TDM XOOPS',
    'author_mail'         => 'jjdelalandre@orange.fr',
    'author_website_url'  => 'https://oritheque.fr',
    'author_website_name' => 'Oritheque',
    'credits'             => 'XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/lexique/docs/release_info file',
    'release_date'        => '2023/07/31',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/lexique/docs/install.txt',
    'min_php'             => '7.0',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.6', 'mysqli' => '5.6'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    'release'             => '2017-12-02',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin templates
    ['file' => 'lexique_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__items.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__labels.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__lists.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__params.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__propertys.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__terms.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__values.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_lex__datatypes.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'lexique_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'lexique_header.tpl', 'description' => ''],
    ['file' => 'lexique_index.tpl', 'description' => ''],
    ['file' => 'lexique_lex__items.tpl', 'description' => ''],
    ['file' => 'lexique_lex__items_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__items_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__labels.tpl', 'description' => ''],
    ['file' => 'lexique_lex__labels_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__labels_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__lists.tpl', 'description' => ''],
    ['file' => 'lexique_lex__lists_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__lists_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__params.tpl', 'description' => ''],
    ['file' => 'lexique_lex__params_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__params_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__propertys.tpl', 'description' => ''],
    ['file' => 'lexique_lex__propertys_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__propertys_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__terms.tpl', 'description' => ''],
    ['file' => 'lexique_lex__terms_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__terms_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__values.tpl', 'description' => ''],
    ['file' => 'lexique_lex__values_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__values_item.tpl', 'description' => ''],
    ['file' => 'lexique_lex__datatypes.tpl', 'description' => ''],
    ['file' => 'lexique_lex__datatypes_list.tpl', 'description' => ''],
    ['file' => 'lexique_lex__datatypes_item.tpl', 'description' => ''],
    ['file' => 'lexique_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'lexique_search.tpl', 'description' => ''],
    ['file' => 'lexique_footer.tpl', 'description' => ''],
];


// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'lexique_lex__items',
    'lexique_lex__labels',
    'lexique_lex__lists',
    'lexique_lex__params',
    'lexique_lex__propertys',
    'lexique_lex__terms',
    'lexique_lex__values',
    'lexique_lex__datatypes',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/search.inc.php',
    'func' => 'lexique_search',
];
// ------------------- Comments ------------------- //
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'lex__params.php';
$modversion['comments']['itemName'] = 'lex_id';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback'] = [
    'approve' => 'lexiqueCommentsApprove',
    'update'  => 'lexiqueCommentsUpdate',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME1,
        'url'  => 'index.php',
    ];
    // Sub lex__items
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME2,
        'url'  => 'lex__items.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME3,
        'url'  => 'lex__items.php?op=new',
    ];
    // Sub lex__labels
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME4,
        'url'  => 'lex__labels.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME5,
        'url'  => 'lex__labels.php?op=new',
    ];
    // Sub lex__lists
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME6,
        'url'  => 'lex__lists.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME7,
        'url'  => 'lex__lists.php?op=new',
    ];
    // Sub lex__params
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME8,
        'url'  => 'lex__params.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME9,
        'url'  => 'lex__params.php?op=new',
    ];
    // Sub lex__propertys
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME10,
        'url'  => 'lex__propertys.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME11,
        'url'  => 'lex__propertys.php?op=new',
    ];
    // Sub lex__terms
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME12,
        'url'  => 'lex__terms.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME13,
        'url'  => 'lex__terms.php?op=new',
    ];
    // Sub lex__values
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME14,
        'url'  => 'lex__values.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_LEXIQUE_SMNAME15,
        'url'  => 'lex__values.php?op=new',
    ];
}
// ------------------- Config ------------------- //
// Editor Admin
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_admin',
    'title'       => '\_MI_LEXIQUE_EDITOR_ADMIN',
    'description' => '\_MI_LEXIQUE_EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor User
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_user',
    'title'       => '\_MI_LEXIQUE_EDITOR_USER',
    'description' => '\_MI_LEXIQUE_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'editor_maxchar',
    'title'       => '\_MI_LEXIQUE_EDITOR_MAXCHAR',
    'description' => '\_MI_LEXIQUE_EDITOR_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 50,
];
// Get groups
$memberHandler = \xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$groups = [];
foreach ($xoopsGroups as $key => $group) {
    $groups[$group]  = $key;
}
// General access groups
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => '\_MI_LEXIQUE_GROUPS',
    'description' => '\_MI_LEXIQUE_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Upload groups
$modversion['config'][] = [
    'name'        => 'upload_groups',
    'title'       => '\_MI_LEXIQUE_UPLOAD_GROUPS',
    'description' => '\_MI_LEXIQUE_UPLOAD_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Get Admin groups
$crGroups = new \CriteriaCompo();
$crGroups->add(new \Criteria('group_type', 'Admin'));
$memberHandler = \xoops_getHandler('member');
$adminXoopsGroups  = $memberHandler->getGroupList($crGroups);
$adminGroups = [];
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $adminGroups[$adminGroup]  = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => '\_MI_LEXIQUE_ADMIN_GROUPS',
    'description' => '\_MI_LEXIQUE_ADMIN_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $adminGroups,
    'options'     => $adminGroups,
];
unset($crGroups);
// Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '\_MI_LEXIQUE_KEYWORDS',
    'description' => '\_MI_LEXIQUE_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'lexique, lex__items, lex__labels, lex__lists, lex__params, lex__propertys, lex__terms, lex__values',
];
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = lexiqueReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = lexiqueReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_LEXIQUE_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
// Uploads : maxsize of image
$modversion['config'][] = [
    'name'        => 'maxsize_image',
    'title'       => '\_MI_LEXIQUE_MAXSIZE_IMAGE',
    'description' => '\_MI_LEXIQUE_MAXSIZE_IMAGE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes_image',
    'title'       => '\_MI_LEXIQUE_MIMETYPES_IMAGE',
    'description' => '\_MI_LEXIQUE_MIMETYPES_IMAGE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
    'name'        => 'maxwidth_image',
    'title'       => '\_MI_LEXIQUE_MAXWIDTH_IMAGE',
    'description' => '\_MI_LEXIQUE_MAXWIDTH_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
$modversion['config'][] = [
    'name'        => 'maxheight_image',
    'title'       => '\_MI_LEXIQUE_MAXHEIGHT_IMAGE',
    'description' => '\_MI_LEXIQUE_MAXHEIGHT_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_LEXIQUE_ADMIN_PAGER',
    'description' => '\_MI_LEXIQUE_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_LEXIQUE_USER_PAGER',
    'description' => '\_MI_LEXIQUE_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Number column
$modversion['config'][] = [
    'name'        => 'numb_col',
    'title'       => '\_MI_LEXIQUE_NUMB_COL',
    'description' => '\_MI_LEXIQUE_NUMB_COL_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Divide by
$modversion['config'][] = [
    'name'        => 'divideby',
    'title'       => '\_MI_LEXIQUE_DIVIDEBY',
    'description' => '\_MI_LEXIQUE_DIVIDEBY_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Table type
$modversion['config'][] = [
    'name'        => 'table_type',
    'title'       => '\_MI_LEXIQUE_TABLE_TYPE',
    'description' => '\_MI_LEXIQUE_DIVIDEBY_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 'bordered',
    'options'     => ['bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed'],
];
// Panel by
$modversion['config'][] = [
    'name'        => 'panel_type',
    'title'       => '\_MI_LEXIQUE_PANEL_TYPE',
    'description' => '\_MI_LEXIQUE_PANEL_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];
// Paypal ID
$modversion['config'][] = [
    'name'        => 'donations',
    'title'       => '\_MI_LEXIQUE_IDPAYPAL',
    'description' => '\_MI_LEXIQUE_IDPAYPAL_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'textbox',
    'default'     => 'XYZ123',
];
// Show Breadcrumbs
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_LEXIQUE_SHOW_BREADCRUMBS',
    'description' => '\_MI_LEXIQUE_SHOW_BREADCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Advertise
$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => '\_MI_LEXIQUE_ADVERTISE',
    'description' => '\_MI_LEXIQUE_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];
// Bookmarks
$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => '\_MI_LEXIQUE_BOOKMARKS',
    'description' => '\_MI_LEXIQUE_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => '_CO_LEXIQUE_' . 'SHOW_SAMPLE_BUTTON',
    'description' => '_CO_LEXIQUE_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_LEXIQUE_MAINTAINEDBY',
    'description' => '\_MI_LEXIQUE_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.org/modules/newbb',
];
