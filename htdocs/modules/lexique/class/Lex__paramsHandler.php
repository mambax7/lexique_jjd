<?php

declare(strict_types=1);


namespace XoopsModules\Lexique;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Lexique module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:jjdelalandre@orange.fr - Website:https://oritheque.fr
 */

use XoopsModules\Lexique;


/**
 * Class Object Handler Lex__params
 */
class Lex__paramsHandler extends \XoopsPersistableObjectHandler
{
public $lexDefault = '';

    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__params', Lex__params::class, 'lex_id', '');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param null fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null)
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Lex__params in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__params($start = 0, $limit = 0, $sort = 'lex_id', $order = 'ASC')
    {
        $crCountLex__params = new \CriteriaCompo();
        $crCountLex__params = $this->getLex__paramsCriteria($crCountLex__params, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__params);
    }

    /**
     * Get All Lex__params in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__params($start = 0, $limit = 0, $sort = 'lex_id', $order = 'ASC')
    {
        $crAllLex__params = new \CriteriaCompo();
        $crAllLex__params = $this->getLex__paramsCriteria($crAllLex__params, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__params);
    }

    /**
     * Get Criteria Lex__params
     * @param        $crLex__params
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__paramsCriteria($crLex__params, $start, $limit, $sort, $order)
    {
        $crLex__params->setStart($start);
        $crLex__params->setLimit($limit);
        $crLex__params->setSort($sort);
        $crLex__params->setOrder($order);
        return $crLex__params;
    }
    
// ============== functions de creation d'un nouveau lexique =======================
/* ********************************

********************************** */
public function getSqlPrefixList(){
global $xoopsDB;

    $prefix = $xoopsDB->prefix('lexique_');
    $suffix = "__params";
    $tablesArr = $this->getAllTableName($prefix);
    $arr = array();
    foreach ($tablesArr AS $key=>$Name){
        if(substr($key,-strlen($suffix)) === $suffix){
            $lexName = substr($key, strlen($prefix), -strlen($suffix)); //$h = strpos()
            $arr[$lexName] = $key;
        }
    }
 
    return $arr; 
}
     
/* ********************************

********************************** */
public function getListArr($actif = -1){
    $arr =  $this->getAllArr('lex_sql_prefix,lex_name,lex_actif,lex_default', $actif);
    $tlist  = array();
    foreach($arr AS $key=>$tlex){
       $tlist[$tlex['lex_sql_prefix']] = $tlex['lex_name'];
    }
    echo "<pre>getListArr =>  : " . print_r($arr, true) . "</pre><br>============================<br>";    
    echo "<pre>getListArr =>  : " . print_r($tlist, true) . "</pre><br>============================<br>";    
    return $tlist;
}

/* ********************************

********************************** */
public function getLexValues($colonnesList="*", $actif = -1){  
    $arr =  $this->getAllArr(null, $actif);
    $ret  = array();
    $lg = strlen('lex_'); //le prefix des champs de la table params est 'lex_'
    
    foreach($arr AS $key=>$tlexParams){
        $tKeys = array_keys($tlexParams);
        $t = array();
//         for($h = 0; $h < count($tKeys); $h++){
//             $t[substr($tKeys, $lg)] = [];
//         }
        foreach($tlexParams AS $fld=>$value){
             $t[substr($fld, $lg)] = $value ;
        
        }
       $ret[$key] = $t;
    }
    return $ret;
}
/* ********************************

********************************** */
public function getAllArr($colonnesList="*", $actif = -1){
global $xoopsDB;
    $arr = $this->getSqlPrefixList();
    if (!$colonnesList) $colonnesList="*";

    $tSql = array();  
    if (!$colonnesList) $colonnesList = '*';
    foreach ($arr AS $key=>$Name){
        $tSql[] = "SELECT {$colonnesList} FROM {$Name}";
    } 
    $sql = implode ("\nUNION ALL\n", $tSql) .";";   
    echo "===> sql union : {$sql}<br>";
    $result = $xoopsDB->queryf($sql);
    $tLex = array();
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        if($myrow['lex_default'] == 1) $this->lexDefault = $myrow['lex_sql_prefix'] ;
        if($actif < 0 || $myrow['lex_actif'] == $actif){
            $tLex[] = $myrow;
        } 
    }
    $arr = $tLex;
  
    //echo "<pre>getAllArr =>" . print_r($arr, true) . "</pre><br>============================<br>"; 
    return $arr; 
}
 
/* ********************************

********************************** */
public function dublicate_all_tables($newLexique){
global $xoopsDB;
    //$tablesArr = getAllTableName($xoopsDB->prefix('lexique_lex__'));
    $tablesArr = $this->getAllTableName();
    $prefixTblToClone = $xoopsDB->prefix('lexique_lex__');
    
    foreach ($tablesArr AS $key=>$Name){
        if(substr($key,0,strlen($prefixTblToClone)) === $prefixTblToClone){
          $newTblName = str_replace("_lex__","_{$newLexique}__", $key);
          echo "===>newTbl : {$newTblName}<br>";
          if (!isset($tablesArr[$newTblName]))  {
              $this->dublicate_table($key, $newLexique);        
          }
        }
    }
    
    //creation d'un enregistrement dans la table params
    $tbl = $xoopsDB->prefix("lexique_{$newLexique}__params");
    $sql = "INSERT INTO $tbl (lex_id,lex_sql_prefix,lex_name, lex_actif) VALUES (1,'{$newLexique}', 'Lexique {$newLexique}', 0)";
    $xoopsDB->queryf($sql);
    $tblFrom = $xoopsDB->prefix("lexique_lex__labels");
    $tblTo = $xoopsDB->prefix("lexique_{$newLexique}__labels");    
    $sql = "INSERT INTO {$tblTo} SELECT * FROM {$tblFrom};";  
    $xoopsDB->queryf($sql);
}

/* ********************************

********************************** */
public function dublicate_table($fulName , $newLexique){
global $xoopsDB;
/*
    while (false !== ($myrow = $this->handler->db->fetchArray($result))) {
        $object = $this->handler->create(false);
        $object->assignVars($myrow);
        $ret[$myrow[$this->handler->keyName]] = $object;
        unset($object);
    }
*/

    //$fulName = $xoopsDB->prefix($table);
    $sql = "SHOW CREATE TABLE `{$fulName}`;";
    echo "sql : {$sql}<br>";
    $result = $xoopsDB->queryf($sql);
    $myrow = $xoopsDB->fetchArray($result);
    $sqlCreate = str_replace("_lex__","_{$newLexique}__", $myrow['Create Table']);
    $h = strpos($sqlCreate, "ENGINE=") ;
    $h = strpos($sqlCreate, " ", $h) ;
    $sqlCreate  = substr($sqlCreate, 0, $h) . ";";  
    //echo "<hr><pre>{$sqlCreate}</pre><hr>";    
    
     //creation de la nouvelle table
     $xoopsDB->queryf($sqlCreate); 

}

/* ********************************

********************************** */
public function getAllTableName($prefix = ''){
global $xoopsDB;
echo "prefix = {$prefix}<br>";
    $arr = array();
    $result = $xoopsDB->queryf('show tables');
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $myrow = array_flip($myrow);
        $tbl = array_key_first($myrow);
        if(!$prefix || substr($tbl,0,strlen($prefix)) === $prefix){
            $arr[$tbl] = $tbl;
        }
        
        
    }
    //echo "<pre>" . print_r($arr, true) . "</pre><br>============================<br>";
    return $arr;

}
/* ********************************

********************************** */
public function killlex($sql_prefix){
global $xoopsDB;
    //ne pas supprimer les table d'installation du module
    if ($sql_prefix == 'lex') return false; 
    //if ($sql_prefix == 'terra') return false; //test 
    
    $prefix = $xoopsDB->prefix("lexique_{$sql_prefix}__");
    $arr = $this->getAllTableName($prefix);
    foreach($arr AS $key=>$name){
        $sql = "DROP TABLE {$name}";
        $xoopsDB->queryf($sql);
    }
    echo "<pre> kill lexique" . print_r($arr, true) . "</pre><br>============================<br>";
}

    
}
