<i id='labId_<{$lex__label.lab_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__label.id}></span>
    <span class='col-sm-9 justify'><{$lex__label.lex_id}></span>
    <span class='col-sm-9 justify'><{$lex__label.code}></span>
    <span class='col-sm-9 justify'><{$lex__label.label}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__labels.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#labId_<{$lex__label.lab_id}>' title='<{$smarty.const._MA_LEXIQUE_LABELS_LIST}>'><{$smarty.const._MA_LEXIQUE_LABELS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__labels.php?op=show&amp;lab_id=<{$lex__label.lab_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__labels.php?op=edit&amp;lab_id=<{$lex__label.lab_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__labels.php?op=clone&amp;lab_id_source=<{$lex__label.lab_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__labels.php?op=delete&amp;lab_id=<{$lex__label.lab_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
