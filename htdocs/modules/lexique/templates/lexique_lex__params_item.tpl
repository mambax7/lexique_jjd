<i id='lexId_<{$lex__param.lex_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__param.id}></span>
    <span class='col-sm-9 justify'><{$lex__param.sql_prefix}></span>
    <span class='col-sm-9 justify'><{$lex__param.category}></span>
    <span class='col-sm-9 justify'><{$lex__param.name}></span>
    <span class='col-sm-9 justify'><{$lex__param.icon}></span>
    <span class='col-sm-9 justify'><{$lex__param.icon_width}></span>
    <span class='col-sm-9 justify'><{$lex__param.description}></span>
    <span class='col-sm-9 justify'><{$lex__param.actif}></span>
    <span class='col-sm-9 justify'><{$lex__param.weight}></span>
    <span class='col-sm-9 justify'><{$lex__param.default}></span>
    <span class='col-sm-9 justify'><{$lex__param.seealso_mode}></span>
    <span class='col-sm-9 justify'><{$lex__param.bin_menus}></span>
    <span class='col-sm-9 justify'><{$lex__param.buttons_position}></span>
    <span class='col-sm-9 justify'><{$lex__param.group_id_mail}></span>
    <span class='col-sm-9 justify'><{$lex__param.bin_search}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_min}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_max}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_img}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_caracters}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_numerique}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_other}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_show_all}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_frames_delimitor}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_letters_separator}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_css_enabled}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_css_selected}></span>
    <span class='col-sm-9 justify'><{$lex__param.selector_css_disabled}></span>
    <span class='col-sm-9 justify'><{$lex__param.bandeau}></span>
    <span class='col-sm-9 justify'><{$lex__param.bandeau_css}></span>
    <span class='col-sm-9 justify'><{$lex__param.term_admin_pager}></span>
    <span class='col-sm-9 justify'><{$lex__param.term_user_pager}></span>
    <span class='col-sm-9 justify'><{$lex__param.term_img_css}></span>
    <span class='col-sm-9 justify'><{$lex__param.terms_visits}></span>
    <span class='col-sm-9 justify'><{$lex__param.date_creation}></span>
    <span class='col-sm-9 justify'><{$lex__param.date_modification}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_count}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_sum}></span>
    <span class='col-sm-9 justify'><{$lex__param.note_average}></span>
    <span class='col-sm-9 justify'><{$lex__param.editor}></span>
    <span class='col-sm-9 justify'><{$lex__param.pos_Image_1}></span>
    <span class='col-sm-9 justify'><{$lex__param.bin_show}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__params.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#lexId_<{$lex__param.lex_id}>' title='<{$smarty.const._MA_LEXIQUE_PARAMS_LIST}>'><{$smarty.const._MA_LEXIQUE_PARAMS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__params.php?op=show&amp;lex_id=<{$lex__param.lex_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__params.php?op=edit&amp;lex_id=<{$lex__param.lex_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__params.php?op=clone&amp;lex_id_source=<{$lex__param.lex_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__params.php?op=delete&amp;lex_id=<{$lex__param.lex_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
