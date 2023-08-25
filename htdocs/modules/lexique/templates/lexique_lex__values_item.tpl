<i id='valId_<{$lex__value.val_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__value.id}></span>
    <span class='col-sm-9 justify'><{$lex__value.lex_id}></span>
    <span class='col-sm-9 justify'><{$lex__value.ppt_id}></span>
    <span class='col-sm-9 justify'><{$lex__value.term_id}></span>
    <span class='col-sm-9 justify'><{$lex__value.value}></span>
    <span class='col-sm-9 justify'><{$lex__value.link}></span>
    <span class='col-sm-9 justify'><{$lex__value.attributs}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__values.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#valId_<{$lex__value.val_id}>' title='<{$smarty.const._MA_LEXIQUE_VALUES_LIST}>'><{$smarty.const._MA_LEXIQUE_VALUES_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__values.php?op=show&amp;val_id=<{$lex__value.val_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__values.php?op=edit&amp;val_id=<{$lex__value.val_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__values.php?op=clone&amp;val_id_source=<{$lex__value.val_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__values.php?op=delete&amp;val_id=<{$lex__value.val_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
