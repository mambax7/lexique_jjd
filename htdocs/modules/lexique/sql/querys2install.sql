
-- Requetes de base de reformulation des tables 
-- Requetes pour front office 


create view `%1$s_lexique_lex__rs_propertys` AS 
select 
  ppt.ppt_id AS ppt_id,
  ppt.ppt_name AS name,
  ppt.ppt_dtype_id AS dtype_id,
  ttyp.dtype_name AS type_name,
  ppt.ppt_active AS active,
  ppt.ppt_weight AS weight,
  ppt.ppt_css AS css,
  ppt.ppt_is_criteria AS is_criteria,
  ppt.ppt_attributs AS attributs
FROM x2511_lexique_lex__propertys ppt
     LEFT JOIN x2511_lexique_lex__datatypes ttyp ON  ttyp.dtype_id = ppt.ppt_dtype_id
ORDER BY ppt.ppt_weight, ppt.ppt_name;

create view `%1$s_lexique_lex__rs_propertys_val` AS 
select 
  ppt.ppt_id AS ppt_id,
  tval.val_term_id AS term_id ,
  tval.val_id AS val_id ,
  ppt.ppt_dtype_id AS dtype_id,
  ppt.ppt_name AS name,
  ppt.ppt_active AS active,
  ppt.ppt_weight AS weight,
  ppt.ppt_css AS css,
  ppt.ppt_is_criteria AS is_criteria,
  ppt.ppt_attributs AS attributs,
  tval.val_value AS val ,
  tval.val_link AS link,
  ttyp.dtype_name AS type_name
FROM x2511_lexique_lex__propertys ppt   USE INDEX(PRIMARY)
     LEFT JOIN x2511_lexique_lex__values tval ON  tval.val_ppt_id = ppt.ppt_id
     LEFT JOIN x2511_lexique_lex__datatypes ttyp ON  ttyp.dtype_id = ppt.ppt_dtype_id
ORDER BY ppt.ppt_weight, ppt.ppt_name, tval.val_term_id;

