<i id='itemId_<{$lex__item.item_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__item.id}></span>
    <span class='col-sm-9 justify'><{$lex__item.list_id}></span>
    <span class='col-sm-9 justify'><{$lex__item.name}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__items.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#itemId_<{$lex__item.item_id}>' title='<{$smarty.const._MA_LEXIQUE_ITEMS_LIST}>'><{$smarty.const._MA_LEXIQUE_ITEMS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__items.php?op=show&amp;item_id=<{$lex__item.item_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__items.php?op=edit&amp;item_id=<{$lex__item.item_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__items.php?op=clone&amp;item_id_source=<{$lex__item.item_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__items.php?op=delete&amp;item_id=<{$lex__item.item_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
