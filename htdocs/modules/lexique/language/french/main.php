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

require_once __DIR__ . '/admin.php';

// ---------------- Main ----------------
\define('_MA_LEXIQUE_INDEX', "Overview Lexique");
\define('_MA_LEXIQUE_TITLE', "Lexique");
\define('_MA_LEXIQUE_DESC', "Gestion multi lexiques");
\define('_MA_LEXIQUE_INDEX_DESC', "Welcome to the homepage of your new module Lexique!<br>This description is only visible on the homepage of this module.");
\define('_MA_LEXIQUE_NO_PDF_LIBRARY', "Libraries TCPDF not there yet, upload them in root/Frameworks");
\define('_MA_LEXIQUE_NO', "No");
\define('_MA_LEXIQUE_DETAILS', "Show details");
\define('_MA_LEXIQUE_BROKEN', "Notify broken");
// ---------------- Contents ----------------
// Lex__item
\define('_MA_LEXIQUE_ITEM', "Lex__item");
\define('_MA_LEXIQUE_ITEM_ADD', "Add Lex__item");
\define('_MA_LEXIQUE_ITEM_EDIT', "Edit Lex__item");
\define('_MA_LEXIQUE_ITEM_DELETE', "Delete Lex__item");
\define('_MA_LEXIQUE_ITEM_CLONE', "Clone Lex__item");
\define('_MA_LEXIQUE_ITEM_DETAILS', "Details Lex__item");
\define('_MA_LEXIQUE_ITEMS', "Lex__items");
\define('_MA_LEXIQUE_ITEMS_LIST', "List of Lex__items");
\define('_MA_LEXIQUE_ITEMS_TITLE', "Lex__items title");
\define('_MA_LEXIQUE_ITEMS_DESC', "Lex__items description");
// Caption of Lex__item
\define('_MA_LEXIQUE_ITEM_ID', "Id");
\define('_MA_LEXIQUE_ITEM_LIST_ID', "List_id");
\define('_MA_LEXIQUE_ITEM_NAME', "Name");
// Lex__label
\define('_MA_LEXIQUE_LABEL', "Lex__label");
\define('_MA_LEXIQUE_LABEL_ADD', "Add Lex__label");
\define('_MA_LEXIQUE_LABEL_EDIT', "Edit Lex__label");
\define('_MA_LEXIQUE_LABEL_DELETE', "Delete Lex__label");
\define('_MA_LEXIQUE_LABEL_CLONE', "Clone Lex__label");
\define('_MA_LEXIQUE_LABEL_DETAILS', "Details Lex__label");
\define('_MA_LEXIQUE_LABELS', "Lex__labels");
\define('_MA_LEXIQUE_LABELS_LIST', "List of Lex__labels");
\define('_MA_LEXIQUE_LABELS_TITLE', "Lex__labels title");
\define('_MA_LEXIQUE_LABELS_DESC', "Lex__labels description");
// Caption of Lex__label
\define('_MA_LEXIQUE_LABEL_ID', "Id");
\define('_MA_LEXIQUE_LABEL_LEX_ID', "Lex_id");
\define('_MA_LEXIQUE_LABEL_CODE', "Code");
\define('_MA_LEXIQUE_LABEL_LABEL', "Label");
// Lex__list
\define('_MA_LEXIQUE_LIST', "Lex__list");
\define('_MA_LEXIQUE_LIST_ADD', "Add Lex__list");
\define('_MA_LEXIQUE_LIST_EDIT', "Edit Lex__list");
\define('_MA_LEXIQUE_LIST_DELETE', "Delete Lex__list");
\define('_MA_LEXIQUE_LIST_CLONE', "Clone Lex__list");
\define('_MA_LEXIQUE_LIST_DETAILS', "Details Lex__list");
\define('_MA_LEXIQUE_LISTS', "Lex__lists");
\define('_MA_LEXIQUE_LISTS_LIST', "List of Lex__lists");
\define('_MA_LEXIQUE_LISTS_TITLE', "Lex__lists title");
\define('_MA_LEXIQUE_LISTS_DESC', "Lex__lists description");
// Caption of Lex__list
\define('_MA_LEXIQUE_LIST_ID', "Id");
\define('_MA_LEXIQUE_LIST_NAME', "Name");
\define('_MA_LEXIQUE_LIST_DESCRIPTION', "Description");
// Lex__param
\define('_MA_LEXIQUE_PARAM', "Lex__param");
\define('_MA_LEXIQUE_PARAM_ADD', "Add Lex__param");
\define('_MA_LEXIQUE_PARAM_EDIT', "Edit Lex__param");
\define('_MA_LEXIQUE_PARAM_DELETE', "Delete Lex__param");
\define('_MA_LEXIQUE_PARAM_CLONE', "Clone Lex__param");
\define('_MA_LEXIQUE_PARAM_DETAILS', "Details Lex__param");
\define('_MA_LEXIQUE_PARAMS', "Lex__params");
\define('_MA_LEXIQUE_PARAMS_LIST', "List of Lex__params");
\define('_MA_LEXIQUE_PARAMS_TITLE', "Lex__params title");
\define('_MA_LEXIQUE_PARAMS_DESC', "Lex__params description");
// Caption of Lex__param
\define('_MA_LEXIQUE_PARAM_ID', "Id");
\define('_MA_LEXIQUE_PARAM_SQL_PREFIX', "Sql_prefix");
\define('_MA_LEXIQUE_PARAM_CATEGORY', "Category");
\define('_MA_LEXIQUE_PARAM_NAME', "Name");
\define('_MA_LEXIQUE_PARAM_ICON', "Icon");
\define('_MA_LEXIQUE_PARAM_ICON_WIDTH', "Icon_width");
\define('_MA_LEXIQUE_PARAM_DESCRIPTION', "Description");
\define('_MA_LEXIQUE_PARAM_ACTIF', "Actif");
\define('_MA_LEXIQUE_PARAM_WEIGHT', "Weight");
\define('_MA_LEXIQUE_PARAM_DEFAULT', "Default");
\define('_MA_LEXIQUE_PARAM_SEEALSO_MODE', "Seealso_mode");
\define('_MA_LEXIQUE_PARAM_BIN_MENUS', "Bin_menus");
\define('_MA_LEXIQUE_PARAM_BUTTONS_POSITION', "Buttons_position");
\define('_MA_LEXIQUE_PARAM_GROUP_ID_MAIL', "Group_id_mail");
\define('_MA_LEXIQUE_PARAM_BIN_SEARCH', "Bin_search");
\define('_MA_LEXIQUE_PARAM_NOTE_MIN', "Note_min");
\define('_MA_LEXIQUE_PARAM_NOTE_MAX', "Note_max");
\define('_MA_LEXIQUE_PARAM_NOTE_IMG', "Note_img");
\define('_MA_LEXIQUE_PARAM_SELECTOR_CARACTERS', "Selector_caracters");
\define('_MA_LEXIQUE_PARAM_SELECTOR_NUMERIQUE', "Selector_numerique");
\define('_MA_LEXIQUE_PARAM_SELECTOR_OTHER', "Selector_other");
\define('_MA_LEXIQUE_PARAM_SELECTOR_SHOW_ALL', "Selector_show_all");
\define('_MA_LEXIQUE_PARAM_SELECTOR_FRAMES_DELIMITOR', "Selector_frames_delimitor");
\define('_MA_LEXIQUE_PARAM_SELECTOR_LETTERS_SEPARATOR', "Selector_letters_separator");
\define('_MA_LEXIQUE_PARAM_SELECTOR_CSS_ENABLED', "Selector_css_enabled");
\define('_MA_LEXIQUE_PARAM_SELECTOR_CSS_SELECTED', "Selector_css_selected");
\define('_MA_LEXIQUE_PARAM_SELECTOR_CSS_DISABLED', "Selector_css_disabled");
\define('_MA_LEXIQUE_PARAM_BANDEAU', "Bandeau");
\define('_MA_LEXIQUE_PARAM_BANDEAU_CSS', "Bandeau_css");
\define('_MA_LEXIQUE_PARAM_TERM_ADMIN_PAGER', "Term_admin_pager");
\define('_MA_LEXIQUE_PARAM_TERM_USER_PAGER', "Term_user_pager");
\define('_MA_LEXIQUE_PARAM_TERM_IMG_CSS', "Term_img_css");
\define('_MA_LEXIQUE_PARAM_TERMS_VISITS', "Terms_visits");
\define('_MA_LEXIQUE_PARAM_DATE_CREATION', "Date_creation");
\define('_MA_LEXIQUE_PARAM_DATE_MODIFICATION', "Date_modification");
\define('_MA_LEXIQUE_PARAM_NOTE_COUNT', "Note_count");
\define('_MA_LEXIQUE_PARAM_NOTE_SUM', "Note_sum");
\define('_MA_LEXIQUE_PARAM_NOTE_AVERAGE', "Note_average");
\define('_MA_LEXIQUE_PARAM_EDITOR', "Editor");
\define('_MA_LEXIQUE_PARAM_POS_IMAGE_1', "Pos_Image_1");
\define('_MA_LEXIQUE_PARAM_BIN_SHOW', "Bin_show");
// Lex__property
\define('_MA_LEXIQUE_PROPERTY', "Lex__property");
\define('_MA_LEXIQUE_PROPERTY_ADD', "Add Lex__property");
\define('_MA_LEXIQUE_PROPERTY_EDIT', "Edit Lex__property");
\define('_MA_LEXIQUE_PROPERTY_DELETE', "Delete Lex__property");
\define('_MA_LEXIQUE_PROPERTY_CLONE', "Clone Lex__property");
\define('_MA_LEXIQUE_PROPERTY_DETAILS', "Details Lex__property");
\define('_MA_LEXIQUE_PROPERTYS', "Lex__propertys");
\define('_MA_LEXIQUE_PROPERTYS_LIST', "List of Lex__propertys");
\define('_MA_LEXIQUE_PROPERTYS_TITLE', "Lex__propertys title");
\define('_MA_LEXIQUE_PROPERTYS_DESC', "Lex__propertys description");
// Caption of Lex__property
\define('_MA_LEXIQUE_PROPERTY_ID', "Id");
\define('_MA_LEXIQUE_PROPERTY_LIST_ID', "List_id");
\define('_MA_LEXIQUE_PROPERTY_TYPE_ID', "Type_id");
\define('_MA_LEXIQUE_PROPERTY_NAME', "Name");
\define('_MA_LEXIQUE_PROPERTY_SEPARATORS', "Separators");
\define('_MA_LEXIQUE_PROPERTY_WEIGHT', "Weight");
\define('_MA_LEXIQUE_PROPERTY_IS_CRITERIA', "Is_criteria");
// Lex__term
\define('_MA_LEXIQUE_TERM', "Lex__term");
\define('_MA_LEXIQUE_TERM_ADD', "Add Lex__term");
\define('_MA_LEXIQUE_TERM_EDIT', "Edit Lex__term");
\define('_MA_LEXIQUE_TERM_DELETE', "Delete Lex__term");
\define('_MA_LEXIQUE_TERM_CLONE', "Clone Lex__term");
\define('_MA_LEXIQUE_TERM_DETAILS', "Details Lex__term");
\define('_MA_LEXIQUE_TERMS', "Lex__terms");
\define('_MA_LEXIQUE_TERMS_LIST', "List of Lex__terms");
\define('_MA_LEXIQUE_TERMS_TITLE', "Lex__terms title");
\define('_MA_LEXIQUE_TERMS_DESC', "Lex__terms description");
// Caption of Lex__term
\define('_MA_LEXIQUE_TERM_ID', "Id");
\define('_MA_LEXIQUE_TERM_LEX_ID', "Lex_id");
\define('_MA_LEXIQUE_TERM_LETTER', "Letter");
\define('_MA_LEXIQUE_TERM_NAME', "Name");
\define('_MA_LEXIQUE_TERM_SHORT_DEF', "Short_def");
\define('_MA_LEXIQUE_TERM_IMAGE_1', "Image_1");
\define('_MA_LEXIQUE_TERM_IMAGE_2', "Image_2");
\define('_MA_LEXIQUE_TERM_IMAGE_3', "Image_3");
\define('_MA_LEXIQUE_TERM_DEFINITION', "Definition");
\define('_MA_LEXIQUE_TERM_SEEALSO', "Seealso");
\define('_MA_LEXIQUE_TERM_SEEALSO_LIST', "Seealso_list");
\define('_MA_LEXIQUE_TERM_STATE', "State");
\define('_MA_LEXIQUE_TERM_VISITS', "Visits");
\define('_MA_LEXIQUE_TERM_USER_CREATION', "User_creation");
\define('_MA_LEXIQUE_TERM_DATE_CREATION', "Date_creation");
\define('_MA_LEXIQUE_TERM_DATE_MODIFICATION', "Date_modification");
// Lex__value
\define('_MA_LEXIQUE_VALUE', "Lex__value");
\define('_MA_LEXIQUE_VALUE_ADD', "Add Lex__value");
\define('_MA_LEXIQUE_VALUE_EDIT', "Edit Lex__value");
\define('_MA_LEXIQUE_VALUE_DELETE', "Delete Lex__value");
\define('_MA_LEXIQUE_VALUE_CLONE', "Clone Lex__value");
\define('_MA_LEXIQUE_VALUE_DETAILS', "Details Lex__value");
\define('_MA_LEXIQUE_VALUES', "Lex__values");
\define('_MA_LEXIQUE_VALUES_LIST', "List of Lex__values");
\define('_MA_LEXIQUE_VALUES_TITLE', "Lex__values title");
\define('_MA_LEXIQUE_VALUES_DESC', "Lex__values description");
// Caption of Lex__value
\define('_MA_LEXIQUE_VALUE_ID', "Id");
\define('_MA_LEXIQUE_VALUE_LEX_ID', "Lex_id");
\define('_MA_LEXIQUE_VALUE_PPT_ID', "Ppt_id");
\define('_MA_LEXIQUE_VALUE_TERM_ID', "Term_id");
\define('_MA_LEXIQUE_VALUE_VALUE', "Value");
\define('_MA_LEXIQUE_VALUE_LINK', "Link");
\define('_MA_LEXIQUE_VALUE_ATTRIBUTS', "Attributs");
\define('_MA_LEXIQUE_INDEX_THEREARE', "There are %s Lex__values");
\define('_MA_LEXIQUE_INDEX_LATEST_LIST', "Last Lexique");
// Submit
\define('_MA_LEXIQUE_SUBMIT', "Submit");
\define('_MA_LEXIQUE_SAVE', "Save");
// Form
\define('_MA_LEXIQUE_FORM_OK', "Successfully saved");
\define('_MA_LEXIQUE_FORM_DELETE_OK', "Successfully deleted");
\define('_MA_LEXIQUE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_LEXIQUE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_LEXIQUE_INVALID_PARAM', "Invalid parameter");
// Admin link
\define('_MA_LEXIQUE_ADMIN', "Admin");
// ---------------- End ----------------
