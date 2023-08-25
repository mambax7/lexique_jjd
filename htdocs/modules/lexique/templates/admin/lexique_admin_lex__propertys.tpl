<!-- Header -->
<{include file='db:lexique_admin_header.tpl' }>

<{if $lex__propertys_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_PROPERTY_ID}></th>
                <{* <th class="center width5"><{$smarty.const._AM_LEXIQUE_PROPERTY_LIST_ID}></th> *}>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PROPERTY_NAME}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PROPERTY_TYPE_LIBELLE}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PROPERTY_WEIGHT}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_ACTIF}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PROPERTY_IS_CRITERIA}></th>
                <th class="center"><{$smarty.const._AM_LEXIQUE_PROPERTY_ATTRIBUTS}></th>
                <th class="center width5"><{$smarty.const._AM_LEXIQUE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $lex__propertys_count|default:''}>
        <tbody>
            <{foreach item=lex__property from=$lex__propertys_list  name=itemsList}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$lex__property.id}></td>
                <{* <td class='center'><{$lex__property.list_id}></td> *}>
                <td class='left'>
                    <a href="lex__propertys.php?op=edit&amp;ppt_id=<{$lex__property.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>">
                        <{$lex__property.name}></td>
                    </a>
                                    
                <td class='left'><{$lex__property.type_libelle}></td>
                <{* ---------------- Arrows Weight -------------------- *}>
                <{assign var="fldImg" value="blue"}>                
                <{assign var="urlImg" value="<{$modPathIcon16}>/arrows/<{$fldImg}>"}>                
                <{assign var="updateUrl" value="lex__propertys.php?op=update_weight&pptId=<{$lex__property.id}>&parentId=0&weight=<{$lex__property.weight}>&start=<{$start}>&limit=<{$limit}>"}>                 
                <td class="center width10"  >
                    <{if $smarty.foreach.itemsList.first}>
                      <img src="<{$urlImg}>/first-0.png" title="<{$smarty.const._AM_LEXIQUE_FIRST}>">
                      <img src="<{$urlImg}>/up-0.png" title="<{$smarty.const._AM_LEXIQUE_UP}>">
                    <{else}>
                      <a href="<{$updateUrl}>&action=first">
                      <img src="<{$urlImg}>/first-1.png" title="<{$smarty.const._AM_LEXIQUE_FIRST}>">
                      </a>
                    
                      <a href="<{$updateUrl}>&action=up}>">
                      <img src="<{$modPathIcon16}>/arrows/<{$fldImg}>/up-1.png" title="<{$smarty.const._AM_LEXIQUE_UP}>">
                      </a>
                    <{/if}>
                 
                    <{* ----------------------------------- *}>
                    <img src="<{$urlImg}>/blank-08.png" title="">
                    <{$lex__property.weight}>
                    <img src="<{$urlImg}>/blank-08.png" title="">
                    <{* ----------------------------------- *}>
                    <{if $smarty.foreach.itemsList.last}>
                      <img src="<{$urlImg}>/down-0.png" title="<{$smarty.const._AM_LEXIQUE_DOWN}>">
                      <img src="<{$urlImg}>/last-0.png" title="<{$smarty.const._AM_LEXIQUE_LAST}>">
                    <{else}>
                    
                    <a href="<{$updateUrl}>&action=down">
                      <img src="<{$urlImg}>/down-1.png" title="<{$smarty.const._AM_LEXIQUE_DOWN}>">
                      </a>
                 
                    <a href="<{$updateUrl}>&action=last">
                      <img src="<{$urlImg}>/last-1.png" title="<{$smarty.const._AM_LEXIQUE_LAST}>">
                      </a>
                    <{/if}>
                
                </td>
                <{* ---------------- /Arrows weight -------------------- *}>
                
                <td class="center">
                    <{if $lex__property.active == 1}>
                        <{assign var="icone" value="on"}>                
                    <{else}>
                        <{assign var="icone" value="off"}>                
                    <{/if}>
                    <a href="lex__propertys.php?op=incremente&ppt_id=<{$lex__property.id}>&fld=ppt_active<{$context}>">
                    <img src="<{$sysPathIcon16}>/<{$icone}>.png" title="">
                    </a>
                </td>

                <td class="center">
                    <{if $lex__property.is_criteria == 1}>
                        <{assign var="icone" value="on"}>                
                    <{else}>
                        <{assign var="icone" value="off"}>                
                    <{/if}>
                    <a href="lex__propertys.php?op=incremente&ppt_id=<{$lex__property.id}>&fld=ppt_is_criteria">
                    <img src="<{$sysPathIcon16}>/<{$icone}>.png" title="">
                    </a>
                </td>
                
                
                <td class='left'><{$lex__property.attributs}></td>
                <td class="center  width5">
                    <a href="lex__propertys.php?op=edit&amp;ppt_id=<{$lex__property.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> lex__propertys" ></a>
                    <a href="lex__propertys.php?op=clone&amp;ppt_id_source=<{$lex__property.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> lex__propertys" ></a>
                    <a href="lex__propertys.php?op=delete&amp;ppt_id=<{$lex__property.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> lex__propertys" ></a>
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
