<i id='termId_<{$lex__term.term_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__term.id}></span>
    <span class='col-sm-9 justify'><{$lex__term.lex_id}></span>
    <span class='col-sm-9 justify'><{$lex__term.letter}></span>
    <span class='col-sm-9 justify'><{$lex__term.name}></span>
    <span class='col-sm-9 justify'><{$lex__term.short_def}></span>
    <span class='col-sm-9 justify'><{$lex__term.image_1}></span>
    <span class='col-sm-9 justify'><{$lex__term.image_2}></span>
    <span class='col-sm-9 justify'><{$lex__term.image_3}></span>
    <span class='col-sm-9 justify'><{$lex__term.definition}></span>
    <span class='col-sm-9 justify'><{$lex__term.seealso}></span>
    <span class='col-sm-9 justify'><{$lex__term.seealso_list}></span>
    <span class='col-sm-9 justify'><{$lex__term.state}></span>
    <span class='col-sm-9 justify'><{$lex__term.visits}></span>
    <span class='col-sm-9 justify'><{$lex__term.user_creation}></span>
    <span class='col-sm-9 justify'><{$lex__term.date_creation}></span>
    <span class='col-sm-9 justify'><{$lex__term.date_modification}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__terms.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#termId_<{$lex__term.term_id}>' title='<{$smarty.const._MA_LEXIQUE_TERMS_LIST}>'><{$smarty.const._MA_LEXIQUE_TERMS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__terms.php?op=show&amp;term_id=<{$lex__term.term_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__terms.php?op=edit&amp;term_id=<{$lex__term.term_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__terms.php?op=clone&amp;term_id_source=<{$lex__term.term_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__terms.php?op=delete&amp;term_id=<{$lex__term.term_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
