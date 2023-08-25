<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<form name="select_filter" id="select_filter" action="lex__items.php" method="post" onsubmit="return xoopsFormValidate_form();" enctype="">
<input type="hidden" name="op" value="list" />
<{$smarty.const._AM_LEXIQUE_LISTE}> : <{$selet_list_id}>
</form>

<{if $lex__items_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_ITEM_ID}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_ITEM_LIST_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_ITEM_NAME}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__items_count|default:''}>
        <tbody>
            <{foreach item=lex__item from=$lex__items_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__item.id}></td>
                <td class='center'><{$lex__item.list_id}></td>
                <td class='left'><{$lex__item.name}></td>
                <td class="center  width5">
                    <a href="lex__items.php?op=edit&amp;item_id=<{$lex__item.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__items" ></a>
                    <a href="lex__items.php?op=clone&amp;item_id_source=<{$lex__item.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__items" ></a>
                    <a href="lex__items.php?op=delete&amp;item_id=<{$lex__item.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__items" ></a>
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
