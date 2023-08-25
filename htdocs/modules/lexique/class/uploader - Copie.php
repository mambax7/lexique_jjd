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

\defined('XOOPS_ROOT_PATH') || die('Restricted access');
echo "<hr>++++++++++++++ Uploader +++++++++++++++++++<hr>";
/**
 * Class Object Lex__datatypes
 */
class FileUploader
{
    /**
     * @var int
     */

    public $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];
    public $maxSize = 400000;
    public $uniqueName = true;
    public $prefix = '';
    public $casseExt = -1; // -1:minuscule +1:majuscule 0: inchangé
    public $casseName = -1; // -1:minuscule +1:majuscule 0: inchangé
    public $folder = '';    
    /*********************************
     * 
     * ******************************* */
    public function __construct($maxSize = null, $extensionsAllowed = null, $uniqueName = true, $prefix = '')
    {
         if ($maxSize)    $this->maxSize = $maxSize;
         if ($extensions) $this->extensions = $extensions;
         
         $this->uniqueName = $uniqueName;
         $this->prefix = $prefix;
    }


    /*********************************
     * 
     * ******************************* */
     function getFolder(){
        return $this->folder;
     }

    /*********************************
     * 
     * ******************************* */
     function setFolder($folder){
        $this->folder = $folder;
     }
    /*********************************
     * 
     * ******************************* */
   function move_upload($arr){
   /*
       [f-121-1] => Array
        (
            [name] => Makotoscat2.jpg
            [type] => image/jpeg
            [tmp_name] => C:\wamp64\tmp\phpD6B.tmp
            [error] => 0
            [size] => 57075
        )
*/

      $tmpName  = $arr['tmp_name'];
      $fullName = $arr['name'];
      $size     = $arr['size'];
      $error    = $arr['error'];
      $type     = $arr['type'];
      
      
      $h = srrpos($fullName, '.');
      $name = substr($fullName, 0, $h);
      $extension = substr($fullName,$h+1);
      
      //test de validtion
        if($error != 0) return $error;
        if(!in_array(strtolower($extension), $extensionsAllowed)) return 1;
        if($size > $maxSize) return 2;
        //--------------------------------------------------------
        switch ($casseExt){
            case -1 :  $extensions = strtolower($extensions); break;
            case  1 :  $extensions = strtoupper($extensions); break;
        }
        switch ($casseName){
            case -1 :  $name = strtolower($name); break;
            case  1 :  $name = strtoupper($name); break;
        }
        //--------------------------------------------------------
        if ($this->uniqueName)  {
            //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
            $newName = uniqid($this->prefix, true);
        }elseif($this->prefix){
            $newName = $this->prefix . '-' . $name;
        }else{
            $newName = $name;
        } 
        //rejout de l'extension
        $newName .= '.' . $extension;
        $file  = $this->folder . "/" . $newName;
        move_uploaded_file($tmpName, XOOPS_ROOT_PATH . '/' .$file);
   }

}
