<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__params_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_ID}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SQL_PREFIX}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_CATEGORY}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NAME}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_ICON}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_ICON_WIDTH}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_DESCRIPTION}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_ACTIF}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_WEIGHT}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_DEFAULT}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SEEALSO_MODE}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BIN_MENUS}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BUTTONS_POSITION}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_GROUP_ID_MAIL}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BIN_SEARCH}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_MIN}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_MAX}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_IMG}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_CARACTERS}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_NUMERIQUE}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_OTHER}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_SHOW_ALL}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_FRAMES_DELIMITOR}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_LETTERS_SEPARATOR}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_CSS_ENABLED}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_CSS_SELECTED}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_SELECTOR_CSS_DISABLED}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BANDEAU}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BANDEAU_CSS}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_TERM_ADMIN_PAGER}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_TERM_USER_PAGER}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_TERM_IMG_CSS}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_TERMS_VISITS}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_DATE_CREATION}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_DATE_MODIFICATION}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_COUNT}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_SUM}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_NOTE_AVERAGE}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_EDITOR}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_POS_IMAGE_1}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_PARAM_BIN_SHOW}></th> *}>
                <{* <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th> *}>
            </tr>
        </thead>
        <{if $lex__params_count|default:''}>
        <tbody>
            <{foreach item=lex__param from=$lex__params_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <{* <td class='center'><{$lex__param.id}></td> *}>
                <td class='left'><{$lex__param.sql_prefix}></td>
                <td class='left'><{$lex__param.category}></td>
                <td class='left'><{$lex__param.name}></td>
                <td class='left'><{$lex__param.icon}></td>
                <{* <td class='center'><{$lex__param.icon_width}></td> *}>
                <{* <td class='center'><{$lex__param.description_short}></td> *}>
                <td class='center'><{$lex__param.actif}></td>
                <td class='center'><{$lex__param.weight}></td>
                <td class='center'><{$lex__param.default}></td>
                <td class='center'><{$lex__param.seealso_mode}></td>
                <{* <td class='center'><{$lex__param.bin_menus}></td> *}>
                <td class='center'><{$lex__param.buttons_position}></td>
                <{* <td class='center'><{$lex__param.group_id_mail}></td> *}>
                <{* <td class='center'><{$lex__param.bin_search}></td> *}>
                <td class='center'><{$lex__param.note_min}></td>
                <td class='center'><{$lex__param.note_max}></td>
                <td class='center'><{$lex__param.note_img}></td>
                <{* <td class='center'><{$lex__param.selector_caracters}></td> *}>
                <{* <td class='center'><{$lex__param.selector_numerique}></td> *}>
                <{* <td class='center'><{$lex__param.selector_other}></td> *}>
                <{* <td class='center'><{$lex__param.selector_show_all}></td> *}>
                <{* <td class='center'><{$lex__param.selector_frames_delimitor}></td> *}>
                <{* <td class='center'><{$lex__param.selector_letters_separator}></td> *}>
                <{* <td class='center'><{$lex__param.selector_css_enabled_short}></td> *}>
                <{* <td class='center'><{$lex__param.selector_css_selected_short}></td> *}>
                <{* <td class='center'><{$lex__param.selector_css_disabled_short}></td> *}>
                <td class='center'><{$lex__param.bandeau}></td>
                <{* <td class='center'><{$lex__param.bandeau_css}></td> *}>
                <{* <td class='center'><{$lex__param.term_admin_pager}></td> *}>
                <{* <td class='center'><{$lex__param.term_user_pager}></td> *}>
                <{* <td class='center'><{$lex__param.term_img_css}></td> *}>
                <td class='center'><{$lex__param.terms_visits}></td>
                <td class='center'><{$lex__param.date_creation}></td>
                <td class='center'><{$lex__param.date_modification}></td>
                <td class='center'><{$lex__param.note_count}></td>
                <td class='center'><{$lex__param.note_sum}></td>
                <td class='center'><{$lex__param.note_average}></td>
                <{* <td class='center'><{$lex__param.editor}></td> *}>
                <td class='center'><{$lex__param.pos_Image_1}></td>
                <{* <td class='center'><{$lex__param.bin_show}></td> *}>
                <{* <td class="center  width5"> *}>
                    <{* <a href="lex__params.php?op=edit&amp;lex_id=<{$lex__param.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__params" ></a> *}>
                    <{* <a href="lex__params.php?op=clone&amp;lex_id_source=<{$lex__param.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__params" ></a> *}>
                    <{* <a href="lex__params.php?op=delete&amp;lex_id=<{$lex__param.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__params" ></a> *}>
                <{* </td> *}>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:lexique_admin_footer.tpl' }>
