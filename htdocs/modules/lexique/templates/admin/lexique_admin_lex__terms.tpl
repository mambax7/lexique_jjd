<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__terms_list|default:''}>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_LEX_ID}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_LETTER}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_NAME}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_SHORT_DEF}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_IMAGES}></th>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_IMAGE_2}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_IMAGE_3}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_DEFINITION}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_SEEALSO}></th> *}>
                <{* <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_SEEALSO_LIST}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_STATE}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_VISITS}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_USER_CREATION}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_DATE_CREATION}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_TERM_DATE_MODIFICATION}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__terms_count|default:''}>
        <tbody>
            <{foreach item=lex__term from=$lex__terms_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__term.id}></td>
                <td class='center'><{$lex__term.lex_id}></td>
                <td class='center'><{$lex__term.letter}></td>
                <td class='left'>
                    <a href="lex__terms.php?op=edit&amp;term_id=<{$lex__term.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>">
                    <{$lex__term.name}>
                    </a><br>
                <{$lex__term.short_def}></td>
                <td class='left'><{$lex__term.image_1}><br>
                <{$lex__term.image_2}><br>
                <{$lex__term.image_3}></td>
                <{* <td class='left'><{$lex__term.definition_short}></td> *}>
                <{* <td class='center'><{$lex__term.seealso}></td> *}>
                <{* <td class='center'><{$lex__term.seealso_list}></td> *}>
                <{* <td class='center'><{$lex__term.state}></td> *}>
                
                
                <td class="center">
                    <a href="lex__terms.php?op=incremente&term_id=<{$lex__term.id}>&fld=term_state&modMax=3<{$context}>">
                    <img src="<{$modPathIcon16}>/status-<{$lex__term.state}>.png" title="">
                    </a>
                </td>
                
                


                
                <td class='center'><{$lex__term.visits}></td>
                <td class='center'><{$lex__term.user_creation}></td>
                <td class='center'><{$lex__term.date_creation}></td>
                <td class='center'><{$lex__term.date_modification}></td>
                <td class="center  width5">
                    <a href="lex__terms.php?op=edit&amp;term_id=<{$lex__term.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__terms" ></a>
                    <a href="lex__terms.php?op=clone&amp;term_id_source=<{$lex__term.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__terms" ></a>
                    <a href="lex__terms.php?op=delete&amp;term_id=<{$lex__term.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__terms" ></a>
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
