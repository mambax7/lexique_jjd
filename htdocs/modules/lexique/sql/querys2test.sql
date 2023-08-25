
-- Requetes de base de reformulation des tables 
-- Requetes pour front office 
-- x2511_

DROP VIEW x2511_lexique_lex__rs_propertys; 
create view `x2511_lexique_lex__rs_propertys` AS 
select 
  tval.val_term_id AS term_id ,
  ppt.ppt_id AS id,
  ppt.ppt_dtype_id AS dtype_id,
  ppt.ppt_name AS name,
  ppt.ppt_active AS active,
  ppt.ppt_weight AS weight,
  ppt.ppt_css AS css,
  ppt.ppt_is_criteria AS is_criteria,
  ppt.ppt_attributs AS attributs_org,
  tval.val_value AS val ,
  tval.val_link AS link,
  tval.val_attributs AS attributs,
FROM x2511_lexique_lex__propertys ppt 
     LEFT JOIN x2511_lexique_lex__values tval ON  tval.val_ppt_id = ppt.ppt_id
ORDER BY tval.val_term_id,ppt.ppt_weight, ppt.ppt_name;     

create view `x2511_lexique_lex__rs_propertys` AS 
select 
  tval.val_term_id AS term_id ,
  ppt.ppt_id AS pptId,
  ppt.ppt_dtype_id AS dtype_id,
  ppt.ppt_name AS name,
  ppt.ppt_active AS active,
  ppt.ppt_weight AS weight,
  ppt.ppt_css AS css,
  ppt.ppt_is_criteria AS is_criteria,
  ppt.ppt_attributs AS attributs_org,
  tval.val_value AS val ,
  tval.val_link AS link,
  tval.val_attributs AS attributs,
  ttyp.dtype_name AS tpe_name
FROM x2511_lexique_lex__propertys ppt 
     LEFT JOIN x2511_lexique_lex__values tval ON  tval.val_ppt_id = ppt.ppt_id
     LEFT JOIN x2511_lexique_lex__datatypes ttyp ON  ttyp.dtype_id = ppt.ppt_dtype_id
ORDER BY tval.val_term_id,ppt.ppt_weight, ppt.ppt_name;

 
INDEX  (tval.val_term_id,ppt.ppt_Id);


select 
  ppt.ppt_id AS ppt_id,
  tval.val_term_id AS term_id ,
  ppt.ppt_dtype_id AS dtype_id,
  ppt.ppt_name AS name,
  ppt.ppt_active AS active,
  ppt.ppt_weight AS weight,
  ppt.ppt_css AS css,
  ppt.ppt_is_criteria AS is_criteria,
  ppt.ppt_attributs AS attributs_org,
  tval.val_value AS val ,
  tval.val_link AS link,
  tval.val_attributs AS attributs,
  ttyp.dtype_name AS tpe_name
FROM x2511_lexique_lex__propertys ppt   USE INDEX(PRIMARY)
     LEFT JOIN x2511_lexique_lex__values tval ON  tval.val_ppt_id = ppt.ppt_id
     LEFT JOIN x2511_lexique_lex__datatypes ttyp ON  ttyp.dtype_id = ppt.ppt_dtype_id
WHERE tval.val_term_id = 1 or tval.val_term_id is null
ORDER BY ppt.ppt_weight, ppt.ppt_name,tval.val_term_id
WHERE tval.val_term_id = 1 or tval.val_term_id is NULL;
