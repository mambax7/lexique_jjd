<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__values_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_LEX_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_PPT_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_TERM_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_VALUE}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_LINK}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_VALUE_ATTRIBUTS}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__values_count|default:''}>
        <tbody>
            <{foreach item=lex__value from=$lex__values_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__value.id}></td>
                <td class='center'><{$lex__value.lex_id}></td>
                <td class='center'><{$lex__value.ppt_id}></td>
                <td class='center'><{$lex__value.term_id}></td>
                <td class='center'><{$lex__value.value_short}></td>
                <td class='center'><{$lex__value.link}></td>
                <td class='center'><{$lex__value.attributs}></td>
                <td class="center  width5">
                    <a href="lex__values.php?op=edit&amp;val_id=<{$lex__value.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__values" ></a>
                    <a href="lex__values.php?op=clone&amp;val_id_source=<{$lex__value.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__values" ></a>
                    <a href="lex__values.php?op=delete&amp;val_id=<{$lex__value.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__values" ></a>
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
