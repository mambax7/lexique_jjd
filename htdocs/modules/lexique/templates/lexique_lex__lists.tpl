<{include file='db:lexique_header.tpl' }>

<{if $lex__listsCount|default:0 > 0}>
<div class='table-responsive'>
    <table class='table table-<{$table_type|default:false}>'>
        <thead>
            <tr class='head'>
                <th colspan='<{$divideby|default:false}>'><{$smarty.const._MA_LEXIQUE_LISTS_TITLE}></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <{foreach item=lex__list from=$lex__lists name=lex__list}>
                <td>
                    <div class='panel panel-<{$panel_type|default:false}>'>
                        <{include file='db:lexique_lex__lists_item.tpl' }>
                    </div>
                </td>
                <{if $smarty.foreach.lex__list.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
                <{/foreach}>
            </tr>
        </tbody>
        <tfoot><tr><td>&nbsp;</td></tr></tfoot>
    </table>
</div>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <{$error|default:false}>
<{/if}>

<{include file='db:lexique_footer.tpl' }>
