<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__labels_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_LABEL_ID}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_LABEL_LEX_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_LABEL_CODE}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_LABEL_LABEL}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__labels_count|default:''}>
        <tbody>
            <{foreach item=lex__label from=$lex__labels_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__label.id}></td>
                <td class='center'><{$lex__label.lex_id}></td>
                <td class='left'><{$lex__label.code}></td>
                <td class='left'><{$lex__label.label}></td>
                <td class="center  width5">
                    <a href="lex__labels.php?op=edit&amp;lab_id=<{$lex__label.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__labels" ></a>
                    <a href="lex__labels.php?op=clone&amp;lab_id_source=<{$lex__label.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__labels" ></a>
                    <a href="lex__labels.php?op=delete&amp;lab_id=<{$lex__label.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__labels" ></a>
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
