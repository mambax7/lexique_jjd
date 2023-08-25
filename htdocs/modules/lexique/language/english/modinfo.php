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

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_LEXIQUE_NAME', "Lexique");
\define('_MI_LEXIQUE_DESC', "Gestion multi lexiques");
// ---------------- Admin Menu ----------------
\define('_MI_LEXIQUE_ADMENU1', "Dashboard");
\define('_MI_LEXIQUE_ADMENU2', "Lex__items");
\define('_MI_LEXIQUE_ADMENU3', "Lex__labels");
\define('_MI_LEXIQUE_ADMENU4', "Lex__lists");
\define('_MI_LEXIQUE_ADMENU5', "Lex__params");
\define('_MI_LEXIQUE_ADMENU6', "Lex__propertys");
\define('_MI_LEXIQUE_ADMENU7', "Lex__terms");
\define('_MI_LEXIQUE_ADMENU8', "Lex__values");
\define('_MI_LEXIQUE_ADMENU9', "Permissions");
\define('_MI_LEXIQUE_ADMENU10', "Clone");
\define('_MI_LEXIQUE_ADMENU11', "Feedback");
\define('_MI_LEXIQUE_ADMENU12', "Types de données");
\define('_MI_LEXIQUE_ABOUT', "About");
// ---------------- Admin Nav ----------------
\define('_MI_LEXIQUE_ADMIN_PAGER', "Admin pager");
\define('_MI_LEXIQUE_ADMIN_PAGER_DESC', "Admin per page list");
// User
\define('_MI_LEXIQUE_USER_PAGER', "User pager");
\define('_MI_LEXIQUE_USER_PAGER_DESC', "User per page list");
// Submenu
\define('_MI_LEXIQUE_SMNAME1', "Index page");
\define('_MI_LEXIQUE_SMNAME2', "Lex__items");
\define('_MI_LEXIQUE_SMNAME3', "Submit Lex__items");
\define('_MI_LEXIQUE_SMNAME4', "Lex__labels");
\define('_MI_LEXIQUE_SMNAME5', "Submit Lex__labels");
\define('_MI_LEXIQUE_SMNAME6', "Lex__lists");
\define('_MI_LEXIQUE_SMNAME7', "Submit Lex__lists");
\define('_MI_LEXIQUE_SMNAME8', "Lex__params");
\define('_MI_LEXIQUE_SMNAME9', "Submit Lex__params");
\define('_MI_LEXIQUE_SMNAME10', "Lex__propertys");
\define('_MI_LEXIQUE_SMNAME11', "Submit Lex__propertys");
\define('_MI_LEXIQUE_SMNAME12', "Lex__terms");
\define('_MI_LEXIQUE_SMNAME13', "Submit Lex__terms");
\define('_MI_LEXIQUE_SMNAME14', "Lex__values");
\define('_MI_LEXIQUE_SMNAME15', "Submit Lex__values");
\define('_MI_LEXIQUE_SMNAME16', "Search");
// Config
\define('_MI_LEXIQUE_EDITOR_ADMIN', "Editor admin");
\define('_MI_LEXIQUE_EDITOR_ADMIN_DESC', "Select the editor which should be used in admin area for text area fields");
\define('_MI_LEXIQUE_EDITOR_USER', "Editor user");
\define('_MI_LEXIQUE_EDITOR_USER_DESC', "Select the editor which should be used in user area for text area fields");
\define('_MI_LEXIQUE_EDITOR_MAXCHAR', "Text max characters");
\define('_MI_LEXIQUE_EDITOR_MAXCHAR_DESC', "Max characters for showing text of a textarea or editor field in admin area");
\define('_MI_LEXIQUE_KEYWORDS', "Keywords");
\define('_MI_LEXIQUE_KEYWORDS_DESC', "Insert here the keywords (separate by comma)");
\define('_MI_LEXIQUE_NUMB_COL', "Number Columns");
\define('_MI_LEXIQUE_NUMB_COL_DESC', "Number Columns to View");
\define('_MI_LEXIQUE_DIVIDEBY', "Divide By");
\define('_MI_LEXIQUE_DIVIDEBY_DESC', "Divide by columns number");
\define('_MI_LEXIQUE_TABLE_TYPE', "Table Type");
\define('_MI_LEXIQUE_TABLE_TYPE_DESC', "Table Type is the bootstrap html table");
\define('_MI_LEXIQUE_PANEL_TYPE', "Panel Type");
\define('_MI_LEXIQUE_PANEL_TYPE_DESC', "Panel Type is the bootstrap html div");
\define('_MI_LEXIQUE_IDPAYPAL', "Paypal ID");
\define('_MI_LEXIQUE_IDPAYPAL_DESC', "Insert here your PayPal ID for donations");
\define('_MI_LEXIQUE_SHOW_BREADCRUMBS', "Show breadcrumb navigation");
\define('_MI_LEXIQUE_SHOW_BREADCRUMBS_DESC', "Show breadcrumb navigation which displays the current page in context within the site structure");
\define('_MI_LEXIQUE_ADVERTISE', "Advertisement Code");
\define('_MI_LEXIQUE_ADVERTISE_DESC', "Insert here the advertisement code");
\define('_MI_LEXIQUE_MAINTAINEDBY', "Maintained By");
\define('_MI_LEXIQUE_MAINTAINEDBY_DESC', "Allow url of support site or community");
\define('_MI_LEXIQUE_BOOKMARKS', "Social Bookmarks");
\define('_MI_LEXIQUE_BOOKMARKS_DESC', "Show Social Bookmarks in the single page");
\define('_MI_LEXIQUE_SIZE_MB', "Mo");
// Permissions Groups
\define('_MI_LEXIQUE_GROUPS', "Groups access");
\define('_MI_LEXIQUE_GROUPS_DESC', "Select general access permission for groups.");
\define('_MI_LEXIQUE_ADMIN_GROUPS', "Admin Group Permissions");
\define('_MI_LEXIQUE_ADMIN_GROUPS_DESC', "Which groups have access to tools and permissions page");
\define('_MI_LEXIQUE_UPLOAD_GROUPS', "Upload Group Permissions");
\define('_MI_LEXIQUE_UPLOAD_GROUPS_DESC', "Which groups have permissions to upload files");
// ---------------- End ----------------
