<{include file='db:lexique_header.tpl' }>

<!-- Start index list -->
<table>
    <thead>
        <tr class='center'>
            <th><{$smarty.const._MA_LEXIQUE_TITLE}>  -  <{$smarty.const._MA_LEXIQUE_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <tr class='center'>
            <td class='bold pad5'>
                <ul class='menu text-center'>
                    <li><a href='<{$lexique_url}>'><{$smarty.const._MA_LEXIQUE_INDEX}></a></li>
                    <li><a href='<{$lexique_url}>/lex__items.php'><{$smarty.const._MA_LEXIQUE_ITEMS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__labels.php'><{$smarty.const._MA_LEXIQUE_LABELS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__lists.php'><{$smarty.const._MA_LEXIQUE_LISTS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__params.php'><{$smarty.const._MA_LEXIQUE_PARAMS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__propertys.php'><{$smarty.const._MA_LEXIQUE_PROPERTYS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__terms.php'><{$smarty.const._MA_LEXIQUE_TERMS}></a></li>
                    <li><a href='<{$lexique_url}>/lex__values.php'><{$smarty.const._MA_LEXIQUE_VALUES}></a></li>
                </ul>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr class='center'>
            <td class='bold pad5'>
                <{if $adv|default:''}><{$adv|default:false}><{/if}>
            </td>
        </tr>
    </tfoot>
</table>
<!-- End index list -->

<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__itemsCount|default:0 > 0}>
    <!-- Start show new lex__items in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__item from=$lex__items name=lex__item}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__items_list.tpl' lex__item=$lex__item}>
                </td>
                <{if $smarty.foreach.lex__item.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__labelsCount|default:0 > 0}>
    <!-- Start show new lex__labels in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__label from=$lex__labels name=lex__label}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__labels_list.tpl' lex__label=$lex__label}>
                </td>
                <{if $smarty.foreach.lex__label.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__listsCount|default:0 > 0}>
    <!-- Start show new lex__lists in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__list from=$lex__lists name=lex__list}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__lists_list.tpl' lex__list=$lex__list}>
                </td>
                <{if $smarty.foreach.lex__list.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__paramsCount|default:0 > 0}>
    <!-- Start show new lex__params in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__param from=$lex__params name=lex__param}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__params_list.tpl' lex__param=$lex__param}>
                </td>
                <{if $smarty.foreach.lex__param.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__propertysCount|default:0 > 0}>
    <!-- Start show new lex__propertys in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__property from=$lex__propertys name=lex__property}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__propertys_list.tpl' lex__property=$lex__property}>
                </td>
                <{if $smarty.foreach.lex__property.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__termsCount|default:0 > 0}>
    <!-- Start show new lex__terms in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__term from=$lex__terms name=lex__term}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__terms_list.tpl' lex__term=$lex__term}>
                </td>
                <{if $smarty.foreach.lex__term.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<div class='lexique-linetitle'><{$smarty.const._MA_LEXIQUE_INDEX_LATEST_LIST}></div>
<{if $lex__valuesCount|default:0 > 0}>
    <!-- Start show new lex__values in index -->
    <table class='table table-<{$table_type}>'>
                    </tr><tr>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=lex__value from=$lex__values name=lex__value}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:lexique_lex__values_list.tpl' lex__value=$lex__value}>
                </td>
                <{if $smarty.foreach.lex__value.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<{include file='db:lexique_footer.tpl' }>
