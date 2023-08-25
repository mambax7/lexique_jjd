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

use XoopsModules\Lexique;


/**
 * search callback functions
 *
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array $itemIds
 */
function lexique_search($queryarray, $andor, $limit, $offset, $userid)
{
    $ret = [];
    $helper = \XoopsModules\Lexique\Helper::getInstance();



    // search in table lex__params
    // search keywords
    $elementCount = 0;
    $lex__paramsHandler = $helper->getHandler('Lex__params');
    if (\is_array($queryarray)) {
        $elementCount = \count($queryarray);
    }
    if ($elementCount > 0) {
        $crKeywords = new \CriteriaCompo();
        for ($i = 0; $i  <  $elementCount; $i++) {
            $crKeyword = new \CriteriaCompo();
            $crKeyword->add(new \Criteria('lex_id', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_sql_prefix', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_category', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_name', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_icon', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_icon_width', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_description', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_actif', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_weight', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_default', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_seealso_mode', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_bin_menus', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_buttons_position', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_group_id_mail', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_bin_search', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_min', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_max', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_img', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_caracters', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_numerique', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_other', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_show_all', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_frames_delimitor', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_letters_separator', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_css_enabled', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_css_selected', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_selector_css_disabled', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_bandeau', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_bandeau_css', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_term_admin_pager', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_term_user_pager', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_term_img_css', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_terms_visits', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_date_creation', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_date_modification', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_count', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_sum', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_note_average', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_editor', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_pos_Image_1', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeyword->add(new \Criteria('lex_bin_show', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $crKeywords->add($crKeyword, $andor);
            unset($crKeyword);
        }
    }
    $crSearch = new \CriteriaCompo();
    if (isset($crKeywords)) {
        $crSearch->add($crKeywords, 'AND');
    }
    $crSearch->setStart($offset);
    $crSearch->setLimit($limit);
    $crSearch->setSort('lex_date_modification');
    $crSearch->setOrder('DESC');
    $lex__paramsAll = $lex__paramsHandler->getAll($crSearch);
    foreach (\array_keys($lex__paramsAll) as $i) {
        $ret[] = [
            'image'  => 'assets/icons/16/lex__params.png',
            'link'   => 'lex__params.php?op=show&amp;lex_id=' . $lex__paramsAll[$i]->getVar('lex_id'),
            'title'  => $lex__paramsAll[$i]->getVar(''),
            'time'   => $lex__paramsAll[$i]->getVar('lex_date_modification')
        ];
    }
    unset($crKeywords);
    unset($crKeyword);
    unset($crUser);
    unset($crSearch);




    return $ret;

}
