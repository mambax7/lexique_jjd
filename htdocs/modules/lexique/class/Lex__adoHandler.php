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
 * builddatatype module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

use XoopsModules\Lexique;


/**
 * Class Object Handler Lex__datatypes
 */

class Lex__adoHandler extends \XoopsPersistableObjectHandler
{


function incrementeField($id, $fldName, $modMax = 2, $newStatus = null){
    if ($newStatus === null){
      $sql = "UPDATE " . $this->table 
           . " SET {$fldName}=mod({$fldName}+1,{$modMax})"
           . " WHERE {$this->keyName}={$id};"; 
    }else{
      $sql = "UPDATE " . $this->table 
           . " SET {$fldName}={$newStatus}"
           . " WHERE {$this->keyName}={$id};";
    }
    $ret = $this->db->queryf($sql);
    return $ret;
}    

}
