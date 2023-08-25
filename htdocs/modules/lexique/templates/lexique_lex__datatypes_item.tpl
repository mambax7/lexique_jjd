<i id='dtypeId_<{$lex__datatype.dtype_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__datatype.name}></span>
    <span class='col-sm-9 justify'><{$lex__datatype.attributs}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__datatypes.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#dtypeId_<{$lex__datatype.dtype_id}>' title='<{$smarty.const._MA_LEXIQUE_DATATYPES_LIST}>'><{$smarty.const._MA_LEXIQUE_DATATYPES_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__datatypes.php?op=show&amp;dtype_id=<{$lex__datatype.dtype_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__datatypes.php?op=edit&amp;dtype_id=<{$lex__datatype.dtype_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__datatypes.php?op=clone&amp;dtype_id_source=<{$lex__datatype.dtype_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__datatypes.php?op=delete&amp;dtype_id=<{$lex__datatype.dtype_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
