<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__datatypes_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_LEXIQUE_DATATYPE_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_DATATYPE_NAME}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_DATATYPE_ATTRIBUTS}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__datatypes_count|default:''}>
        <tbody>
            <{foreach item=lex__datatype from=$lex__datatypes_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__datatype.id}></td>
                <td class='left'>
                    <a href="lex__datatypes.php?op=edit&amp;dtype_id=<{$lex__datatype.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>">
                        <{$lex__datatype.name}>
                    </a>
                </td>
                                    
                <td class='left'><{$lex__datatype.attributs}></td>
                <td class="center  width5">
                    <a href="lex__datatypes.php?op=edit&amp;dtype_id=<{$lex__datatype.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__datatypes" ></a>
                    <a href="lex__datatypes.php?op=clone&amp;dtype_id_source=<{$lex__datatype.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__datatypes" ></a>
                    <a href="lex__datatypes.php?op=delete&amp;dtype_id=<{$lex__datatype.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__datatypes" ></a>
                </td>
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
