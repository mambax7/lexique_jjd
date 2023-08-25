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
require_once __DIR__ . '/main.php';

// ---------------- Admin Index ----------------
\define('_AM_LEXIQUE_STATISTICS', "Statistics");
// There are
\define('_AM_LEXIQUE_THEREARE_LEX__ITEMS', "There are <span class='bold'>%s</span> lex__items in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__LABELS', "There are <span class='bold'>%s</span> lex__labels in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__LISTS', "There are <span class='bold'>%s</span> lex__lists in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__PARAMS', "There are <span class='bold'>%s</span> lex__params in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__PROPERTYS', "There are <span class='bold'>%s</span> lex__propertys in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__TERMS', "There are <span class='bold'>%s</span> lex__terms in the database");
\define('_AM_LEXIQUE_THEREARE_LEX__VALUES', "There are <span class='bold'>%s</span> lex__values in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_LEXIQUE_THEREARENT_LEX__ITEMS', "There aren't lex__items");
\define('_AM_LEXIQUE_THEREARENT_LEX__LABELS', "There aren't lex__labels");
\define('_AM_LEXIQUE_THEREARENT_LEX__LISTS', "There aren't lex__lists");
\define('_AM_LEXIQUE_THEREARENT_LEX__PARAMS', "There aren't lex__params");
\define('_AM_LEXIQUE_THEREARENT_LEX__PROPERTYS', "There aren't lex__propertys");
\define('_AM_LEXIQUE_THEREARENT_LEX__TERMS', "There aren't lex__terms");
\define('_AM_LEXIQUE_THEREARENT_LEX__VALUES', "There aren't lex__values");
// Save/Delete
\define('_AM_LEXIQUE_FORM_OK', "Successfully saved");
\define('_AM_LEXIQUE_FORM_DELETE_OK', "Successfully deleted");
\define('_AM_LEXIQUE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_LEXIQUE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
\define('_AM_LEXIQUE_ADD_LEX__ITEM', "Add New Lex__item");
\define('_AM_LEXIQUE_ADD_LEX__LABEL', "Add New Lex__label");
\define('_AM_LEXIQUE_ADD_LEX__LIST', "Add New Lex__list");
\define('_AM_LEXIQUE_ADD_LEX__PARAM', "Add New Lex__param");
\define('_AM_LEXIQUE_ADD_LEX__PROPERTY', "Add New Lex__property");
\define('_AM_LEXIQUE_ADD_LEX__TERM', "Add New Lex__term");
\define('_AM_LEXIQUE_ADD_LEX__VALUE', "Add New Lex__value");
// Lists
\define('_AM_LEXIQUE_LIST_LEX__ITEMS', "List of Lex__items");
\define('_AM_LEXIQUE_LIST_LEX__LABELS', "List of Lex__labels");
\define('_AM_LEXIQUE_LIST_LEX__LISTS', "List of Lex__lists");
\define('_AM_LEXIQUE_LIST_LEX__PARAMS', "List of Lex__params");
\define('_AM_LEXIQUE_LIST_LEX__PROPERTYS', "List of Lex__propertys");
\define('_AM_LEXIQUE_LIST_LEX__TERMS', "List of Lex__terms");
\define('_AM_LEXIQUE_LIST_LEX__VALUES', "List of Lex__values");
// ---------------- Admin Classes ----------------
// Lex__item add/edit
\define('_AM_LEXIQUE_ITEM_ADD', "Add Lex__item");
\define('_AM_LEXIQUE_ITEM_EDIT', "Edit Lex__item");
// Elements of Lex__item
\define('_AM_LEXIQUE_ITEM_ID', "Id");
\define('_AM_LEXIQUE_ITEM_LIST_ID', "List id");
\define('_AM_LEXIQUE_ITEM_NAME', "Name");
// Lex__label add/edit
\define('_AM_LEXIQUE_LABEL_ADD', "Add Lex__label");
\define('_AM_LEXIQUE_LABEL_EDIT', "Edit Lex__label");
// Elements of Lex__label
\define('_AM_LEXIQUE_LABEL_ID', "Id");
\define('_AM_LEXIQUE_LABEL_LEX_ID', "Lex id");
\define('_AM_LEXIQUE_LABEL_CODE', "Code");
\define('_AM_LEXIQUE_LABEL_LABEL', "Label");
// Lex__list add/edit
\define('_AM_LEXIQUE_LIST_ADD', "Add Lex__list");
\define('_AM_LEXIQUE_LIST_EDIT', "Edit Lex__list");
// Elements of Lex__list
\define('_AM_LEXIQUE_LIST_ID', "Id");
\define('_AM_LEXIQUE_LIST_NAME', "Name");
\define('_AM_LEXIQUE_LIST_DESCRIPTION', "Description");
// Lex__param add/edit
\define('_AM_LEXIQUE_PARAM_ADD', "Add Lex__param");
\define('_AM_LEXIQUE_PARAM_EDIT', "Edit Lex__param");
// Elements of Lex__param
\define('_AM_LEXIQUE_PARAM_ID', "Id");
\define('_AM_LEXIQUE_PARAM_SQL_PREFIX', "Sql prefix");
\define('_AM_LEXIQUE_PARAM_CATEGORY', "Category");
\define('_AM_LEXIQUE_PARAM_NAME', "Name");
\define('_AM_LEXIQUE_PARAM_ICON', "Icon");
\define('_AM_LEXIQUE_PARAM_ICON_WIDTH', "Icon width");
\define('_AM_LEXIQUE_PARAM_DESCRIPTION', "Description");
\define('_AM_LEXIQUE_PARAM_ACTIF', "Actif");
\define('_AM_LEXIQUE_PARAM_WEIGHT', "Weight");
\define('_AM_LEXIQUE_PARAM_WEIGHT_DESC', "Inutilisé pour l'instant. en prévision d'un bloc qui répertorira tous les clones du module");
\define('_AM_LEXIQUE_PARAM_DEFAULT', "Default");
\define('_AM_LEXIQUE_PARAM_SEEALSO_MODE', "Seealso mode");
\define('_AM_LEXIQUE_PARAM_BIN_MENUS', "Bin menus");
\define('_AM_LEXIQUE_PARAM_BUTTONS_POSITION', "Buttons position");
\define('_AM_LEXIQUE_PARAM_GROUP_ID_MAIL', "Group id mail");
\define('_AM_LEXIQUE_PARAM_GROUP_ID_MAIL_DESC', "Ce goupe recevra un courriel à chaque nouveau termes ou modification d'un terme");
\define('_AM_LEXIQUE_PARAM_BIN_SEARCH', "Bin search");
\define('_AM_LEXIQUE_PARAM_BIN_SEARCH_NAME', "Nom");
\define('_AM_LEXIQUE_PARAM_BIN_SEARCH_SHORT_DEF', "Définition courte");
\define('_AM_LEXIQUE_PARAM_BIN_SEARCH_DEFINITION', "Description");
\define('_AM_LEXIQUE_PARAM_NOTE_MIN', "Note min");
\define('_AM_LEXIQUE_PARAM_NOTE_MAX', "Note max");
\define('_AM_LEXIQUE_PARAM_NOTE_IMG', "Note img");
\define('_AM_LEXIQUE_PARAM_NOTE_IMG_UPLOADS', "Note img in %s :");
\define('_AM_LEXIQUE_PARAM_SELECTOR_CARACTERS', "Selector caracters");
\define('_AM_LEXIQUE_PARAM_SELECTOR_CARACTERS_DESC', "Liste des caracteres du sélecteur alpha-numérique");
\define('_AM_LEXIQUE_PARAM_SELECTOR_NUMERIQUE', "Selector numerique");
\define('_AM_LEXIQUE_PARAM_SELECTOR_NUMERIQUE_DESC', "Caractère à afficher pour sélectionner les termes commençant par un chiffre");
\define('_AM_LEXIQUE_PARAM_SELECTOR_OTHER', "Selector other");
\define('_AM_LEXIQUE_PARAM_SELECTOR_SHOW_ALL', "Selector show all");
\define('_AM_LEXIQUE_PARAM_SELECTOR_SHOW_ALL_DESC', "Permet de limiter le sélecteur alpha-numérique aux seules initiales des termes présents dans le lexique");
\define('_AM_LEXIQUE_PARAM_SELECTOR_FRAMES_DELIMITOR', "Selector frames delimitor");
\define('_AM_LEXIQUE_PARAM_SELECTOR_LETTERS_SEPARATOR', "Selector letters separator");
\define('_AM_LEXIQUE_PARAM_SELECTOR_CSS_ENABLED', "Selector css enabled");
\define('_AM_LEXIQUE_PARAM_SELECTOR_CSS_SELECTED', "Selector css selected");
\define('_AM_LEXIQUE_PARAM_SELECTOR_CSS_DISABLED', "Selector css disabled");
\define('_AM_LEXIQUE_PARAM_BANDEAU', "Bandeau");
\define('_AM_LEXIQUE_PARAM_BANDEAU_UPLOADS', "Bandeau in %s :");
\define('_AM_LEXIQUE_PARAM_BANDEAU_CSS', "Bandeau css");
\define('_AM_LEXIQUE_PARAM_BANDEAU_CSS_UPLOADS', "Bandeau css in %s :");
\define('_AM_LEXIQUE_PARAM_TERM_ADMIN_PAGER', "Term admin pager");
\define('_AM_LEXIQUE_PARAM_TERM_USER_PAGER', "Term user pager");
\define('_AM_LEXIQUE_PARAM_TERM_IMG_CSS', "Term img css");
\define('_AM_LEXIQUE_PARAM_TERM_IMG_CSS_UPLOADS', "Term img css in %s :");
\define('_AM_LEXIQUE_PARAM_TERMS_VISITS', "Terms visits");
\define('_AM_LEXIQUE_PARAM_DATE_CREATION', "Date creation");
\define('_AM_LEXIQUE_PARAM_DATE_MODIFICATION', "Date modification");
\define('_AM_LEXIQUE_PARAM_NOTE_COUNT', "Note count");
\define('_AM_LEXIQUE_PARAM_NOTE_SUM', "Note sum");
\define('_AM_LEXIQUE_PARAM_NOTE_AVERAGE', "Note average");
\define('_AM_LEXIQUE_PARAM_EDITOR', "Editor");
\define('_AM_LEXIQUE_PARAM_EDITOR_DESC', "Editeur pour les termes");
\define('_AM_LEXIQUE_PARAM_POS_IMAGE_1', "Pos Image 1");
\define('_AM_LEXIQUE_PARAM_BIN_SHOW', "Bin show");
// Lex__property add/edit
\define('_AM_LEXIQUE_PROPERTY_ADD', "Add Lex__property");
\define('_AM_LEXIQUE_PROPERTY_EDIT', "Edit Lex__property");
// Elements of Lex__property
\define('_AM_LEXIQUE_PROPERTY_ID', "Id");
\define('_AM_LEXIQUE_PROPERTY_LIST_ID', "List id");
\define('_AM_LEXIQUE_PROPERTY_TYPE_ID', "Type id");
\define('_AM_LEXIQUE_PROPERTY_NAME', "Name");
\define('_AM_LEXIQUE_PROPERTY_SEPARATORS', "Separators");
\define('_AM_LEXIQUE_PROPERTY_WEIGHT', "Weight");
\define('_AM_LEXIQUE_PROPERTY_IS_CRITERIA', "Is criteria");
// Lex__term add/edit
\define('_AM_LEXIQUE_TERM_ADD', "Add Lex__term");
\define('_AM_LEXIQUE_TERM_EDIT', "Edit Lex__term");
// Elements of Lex__term
\define('_AM_LEXIQUE_TERM_ID', "Id");
\define('_AM_LEXIQUE_TERM_LEX_ID', "Lex id");
\define('_AM_LEXIQUE_TERM_LETTER', "Letter");
\define('_AM_LEXIQUE_TERM_NAME', "Name");
\define('_AM_LEXIQUE_TERM_SHORT_DEF', "Short def");
\define('_AM_LEXIQUE_TERM_IMAGE_1', "Image 1");
\define('_AM_LEXIQUE_TERM_IMAGE_1_UPLOADS', "Image 1 in %s :");
\define('_AM_LEXIQUE_TERM_IMAGE_2', "Image 2");
\define('_AM_LEXIQUE_TERM_IMAGE_2_UPLOADS', "Image 2 in %s :");
\define('_AM_LEXIQUE_TERM_IMAGE_3', "Image 3");
\define('_AM_LEXIQUE_TERM_IMAGE_3_UPLOADS', "Image 3 in %s :");
\define('_AM_LEXIQUE_TERM_DEFINITION', "Definition");
\define('_AM_LEXIQUE_TERM_SEEALSO', "Seealso");
\define('_AM_LEXIQUE_TERM_SEEALSO_DESC', "Indiquer ici un lien par ligne sous la forme nom|url ");
\define('_AM_LEXIQUE_TERM_SEEALSO_LIST', "Seealso list");
\define('_AM_LEXIQUE_TERM_STATE', "State");
\define('_AM_LEXIQUE_TERM_VISITS', "Visits");
\define('_AM_LEXIQUE_TERM_USER_CREATION', "User creation");
\define('_AM_LEXIQUE_TERM_DATE_CREATION', "Date creation");
\define('_AM_LEXIQUE_TERM_DATE_MODIFICATION', "Date modification");
// Lex__value add/edit
\define('_AM_LEXIQUE_VALUE_ADD', "Add Lex__value");
\define('_AM_LEXIQUE_VALUE_EDIT', "Edit Lex__value");
// Elements of Lex__value
\define('_AM_LEXIQUE_VALUE_ID', "Id");
\define('_AM_LEXIQUE_VALUE_LEX_ID', "Lex id");
\define('_AM_LEXIQUE_VALUE_PPT_ID', "Ppt id");
\define('_AM_LEXIQUE_VALUE_TERM_ID', "Term id");
\define('_AM_LEXIQUE_VALUE_VALUE', "Value");
\define('_AM_LEXIQUE_VALUE_LINK', "Link");
\define('_AM_LEXIQUE_VALUE_ATTRIBUTS', "Attributs");
// General
\define('_AM_LEXIQUE_FORM_UPLOAD', "Upload file");
\define('_AM_LEXIQUE_FORM_UPLOAD_NEW', "Upload new file: ");
\define('_AM_LEXIQUE_FORM_UPLOAD_SIZE', "Max file size: ");
\define('_AM_LEXIQUE_FORM_UPLOAD_SIZE_MB', "MB");
\define('_AM_LEXIQUE_FORM_UPLOAD_IMG_WIDTH', "Max image width: ");
\define('_AM_LEXIQUE_FORM_UPLOAD_IMG_HEIGHT', "Max image height: ");
\define('_AM_LEXIQUE_FORM_IMAGE_PATH', "Files in %s :");
\define('_AM_LEXIQUE_FORM_ACTION', "Action");
\define('_AM_LEXIQUE_FORM_EDIT', "Modification");
\define('_AM_LEXIQUE_FORM_DELETE', "Clear");
// Sample List Values
\define('_AM_LEXIQUE_LIST_1', "Sample List Value 1");
\define('_AM_LEXIQUE_LIST_2', "Sample List Value 2");
\define('_AM_LEXIQUE_LIST_3', "Sample List Value 3");
// Clone feature
\define('_AM_LEXIQUE_CLONE', "Clone");
\define('_AM_LEXIQUE_CLONE_DSC', "Cloning a module has never been this easy! Just type in the name you want for it and hit submit button!");
\define('_AM_LEXIQUE_CLONE_TITLE', "Clone %s");
\define('_AM_LEXIQUE_CLONE_NAME', "Choose a name for the new module");
\define('_AM_LEXIQUE_CLONE_NAME_DSC', "Do not use special characters! <br>Do not choose an existing module dirname or database table name!");
\define('_AM_LEXIQUE_CLONE_INVALIDNAME', "ERROR: Invalid module name, please try another one!");
\define('_AM_LEXIQUE_CLONE_EXISTS', "ERROR: Module name already taken, please try another one!");
\define('_AM_LEXIQUE_CLONE_CONGRAT', "Congratulations! %s was sucessfully created!<br>You may want to make changes in language files.");
\define('_AM_LEXIQUE_CLONE_IMAGEFAIL', "Attention, we failed creating the new module logo. Please consider modifying assets/images/logo_module.png manually!");
\define('_AM_LEXIQUE_CLONE_FAIL', "Sorry, we failed in creating the new clone. Maybe you need to temporally set write permissions (CHMOD 777) to modules folder and try again.");
// ---------------- Admin Permissions ----------------
// Permissions
\define('_AM_LEXIQUE_PERMISSIONS_GLOBAL', "Permissions global");
\define('_AM_LEXIQUE_PERMISSIONS_GLOBAL_DESC', "Permissions global to check type of.");
\define('_AM_LEXIQUE_PERMISSIONS_GLOBAL_4', "Permissions global to approve");
\define('_AM_LEXIQUE_PERMISSIONS_GLOBAL_8', "Permissions global to submit");
\define('_AM_LEXIQUE_PERMISSIONS_GLOBAL_16', "Permissions global to view");
\define('_AM_LEXIQUE_PERMISSIONS_APPROVE', "Permissions to approve");
\define('_AM_LEXIQUE_PERMISSIONS_APPROVE_DESC', "Permissions to approve");
\define('_AM_LEXIQUE_PERMISSIONS_SUBMIT', "Permissions to submit");
\define('_AM_LEXIQUE_PERMISSIONS_SUBMIT_DESC', "Permissions to submit");
\define('_AM_LEXIQUE_PERMISSIONS_VIEW', "Permissions to view");
\define('_AM_LEXIQUE_PERMISSIONS_VIEW_DESC', "Permissions to view");
\define('_AM_LEXIQUE_NO_PERMISSIONS_SET', "No permission set");
// ---------------- Admin Others ----------------
\define('_AM_LEXIQUE_ABOUT_MAKE_DONATION', "Submit");
\define('_AM_LEXIQUE_SUPPORT_FORUM', "Support Forum");
\define('_AM_LEXIQUE_DONATION_AMOUNT', "Donation Amount");
\define('_AM_LEXIQUE_MAINTAINEDBY', " is maintained by ");
// ---------------- End ----------------
