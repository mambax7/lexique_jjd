<i id='pptId_<{$lex__property.ppt_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$lex__property.id}></span>
    <span class='col-sm-9 justify'><{$lex__property.list_id}></span>
    <span class='col-sm-9 justify'><{$lex__property.type_id}></span>
    <span class='col-sm-9 justify'><{$lex__property.name}></span>
    <span class='col-sm-9 justify'><{$lex__property.separators}></span>
    <span class='col-sm-9 justify'><{$lex__property.weight}></span>
    <span class='col-sm-9 justify'><{$lex__property.is_criteria}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:''}>
            <a class='btn btn-success right' href='lex__propertys.php?op=list&amp;start=<{$start}>&amp;limit=<{$limit}>#pptId_<{$lex__property.ppt_id}>' title='<{$smarty.const._MA_LEXIQUE_PROPERTYS_LIST}>'><{$smarty.const._MA_LEXIQUE_PROPERTYS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='lex__propertys.php?op=show&amp;ppt_id=<{$lex__property.ppt_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MA_LEXIQUE_DETAILS}>'><{$smarty.const._MA_LEXIQUE_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:''}>
            <a class='btn btn-primary right' href='lex__propertys.php?op=edit&amp;ppt_id=<{$lex__property.ppt_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='lex__propertys.php?op=clone&amp;ppt_id_source=<{$lex__property.ppt_id}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='lex__propertys.php?op=delete&amp;ppt_id=<{$lex__property.ppt_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
