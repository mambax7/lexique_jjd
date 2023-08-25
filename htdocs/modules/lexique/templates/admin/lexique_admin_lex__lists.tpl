<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__lists_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_LEXIQUE_LIST_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_LIST_NAME}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_LIST_DESCRIPTION}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__lists_count|default:''}>
        <tbody>
            <{foreach item=lex__list from=$lex__lists_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__list.id}></td>
                <td class='center'><{$lex__list.name}></td>
                <td class='center'><{$lex__list.description_short}></td>
                <td class="center  width5">
                    <a href="lex__lists.php?op=edit&amp;list_id=<{$lex__list.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__lists" ></a>
                    <a href="lex__lists.php?op=clone&amp;list_id_source=<{$lex__list.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__lists" ></a>
                    <a href="lex__lists.php?op=delete&amp;list_id=<{$lex__list.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__lists" ></a>
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
