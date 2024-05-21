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
 * Class Object Handler Lex__propertys
 */
//class Lex__propertysHandler extends \XoopsPersistableObjectHandler
class Lex__propertysHandler extends Lex__adoHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__propertys', Lex__propertys::class, 'ppt_id', '');
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
     * Get Count Lex__propertys in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__propertys($start = 0, $limit = 0, $sort = 'ppt_id', $order = 'ASC')
    {
        $crCountLex__propertys = new \CriteriaCompo();
        $crCountLex__propertys = $this->getLex__propertysCriteria($crCountLex__propertys, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__propertys);
    }

    /**
     * Get All Lex__propertys in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__propertys($crAllLex__propertys = null, $start = 0, $limit = 0, $sort = 'ppt_id', $order = 'ASC')
    {
        if(!$crAllLex__propertys) $crAllLex__propertys = new \CriteriaCompo();
        $crAllLex__propertys = $this->getLex__propertysCriteria($crAllLex__propertys, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__propertys);
    }
    
    
    
//     public function getAllLex__propertysArr($crAllLex__propertys = null)
//     {
//         if(!$crAllLex__propertys) $crAllLex__propertys = new \CriteriaCompo();
//         $crAllLex__propertys = $this->getLex__propertysCriteria($crAllLex__propertys, 0, 0, 'ppt_weight', 'ASC');
//         return $this->getAll($crAllLex__propertys, null, false);
//     }

    public function getAllLex__propertysArr($active=-1)
    {
        $sql = "SELECT * FROM "   . $this->db->prefix('lexique_lex__rs_propertys') 
        . (($active >=0) ? " WHERE active={$active}" : '' )
        . ";";
        $result = $this->db->query($sql);        
        $ret = array();
        while (false !== ($myrow = $this->db->fetchArray($result))) {
                $ret[$myrow['ppt_id']] = $myrow ;
        }
        return $ret;

    }

    
    
    /**
     * Get Criteria Lex__propertys
     * @param        $crLex__propertys
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__propertysCriteria($crLex__propertys, $start, $limit, $sort, $order)
    {
        $crLex__propertys->setStart($start);
        $crLex__propertys->setLimit($limit);
        $crLex__propertys->setSort($sort);
        $crLex__propertys->setOrder($order);
        return $crLex__propertys;
    }
    
    /* ******************************
 * Update weight
 * *********************** */
 function updateWeight($sourceId, $action, $step = 10,  $fldParentId = null){
 global $xoopsDB;
 $table = $this->table;
 $fldWeight = 'ppt_weight';
 $fldId = 'ppt_id';    
 
    //recherche de la collection parent  si besoin
    if($fldParentId){
        $enrObj = $this->get($sourceId);
        $parentId = $enrObj->getVar($fldParentId);
    //echo "poids {$sourceId}/{$albCollId} = " . $enrObj->getVar($fldWeight) . "<br>";
        $clauseWhere = "WHERE {$fldParentId}={$parentId}";     

    }else{
        $clauseWhere = "";     
    }
        $clauseOrder = "ORDER BY {$fldWeight},{$fldId}";
 
 
         switch ($action){
            case 'up'; 
              $newValue = "{$fldWeight} = {$fldWeight}-{$step}-1";
              break;

            case 'down'; 
              $newValue = "{$fldWeight} = {$fldWeight}+{$step}+1";
            break;

            case 'first'; 
              $newValue = "{$fldWeight} = -99999";
            break;

            case 'last'; 
              $newValue = "{$fldWeight} = 99999";
              
            default; 
              $newValue = "{$fldWeight} = 88888";
            break;
            
         }
    //defini le poids du premier element
    $firstWeight = $step;
    $sql = "SET @rank={$firstWeight};";
    $result = $xoopsDB->queryf($sql);
    
    //recalcul le poids pour la collection
    $sql = "UPDATE {$table} SET {$fldWeight} = (@rank:=@rank+{$step}) {$clauseWhere} {$clauseOrder};";    
    $result = $xoopsDB->queryf($sql);
    //----------------------------------------------------------
    //affectation de la nouvelle à l'album selectionné
   // $enrObj->setVar($fldWeight, );
    //$this->insert($enrObj);
     $sql = "UPDATE {$table} SET {$newValue} WHERE {$fldId}={$sourceId}"; 
     $xoopsDB->queryf($sql);
//echo "poids {$sourceId}/{$albCollId} = " . $enrObj->getVar($fldWeight) . "<br>";
    //----------------------------------------------------------
    //recalcul du poids par pas de 10 (par default)
    //$firstWeight = $step;
    $sql = "SET @rank={$firstWeight};";
    $result = $xoopsDB->queryf($sql);

    $sql = "UPDATE {$table} SET {$fldWeight} = (@rank:=@rank+{$step}) {$clauseWhere} {$clauseOrder};";    
    $result = $xoopsDB->queryf($sql);
 }
 
   

}
