<i id='listId_<{$lex__list.list_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__list.id}></span>
    <span class='col-sm-9 justify'><{$lex__list.name}></span>
    <span class='col-sm-9 justify'><{$lex__list.description}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__lists.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#listId_<{$lex__list.list_id}>' title='<{$smarty.const._MA_LEXIQUE_LISTS_LIST}>'><{$smarty.const._MA_LEXIQUE_LISTS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__lists.php?op=show&amp;list_id=<{$lex__list.list_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__lists.php?op=edit&amp;list_id=<{$lex__list.list_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__lists.php?op=clone&amp;list_id_source=<{$lex__list.list_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__lists.php?op=delete&amp;list_id=<{$lex__list.list_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
