<?php

declare(strict_types=1);




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



//\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Lex__datatypes
 */
class FileUploader
{
    /**
     * @var int
     */

    public $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif','pdf','txt','zip',];
    public $maxSize = 4000000;   //4mo par defaut
    public $uniqueName = true;
    public $prefix = '';
    public $casseExt = -1; // -1:minuscule +1:majuscule 0: inchangé
    public $casseName = -1; // -1:minuscule +1:majuscule 0: inchangé
    public $folder = '';    
    public $path = '';    
    public $sepPrefix = '-';    
    public $overwrite = true;    
    public $lastError = 0;    
    
    public const UPLOADER_ERR_NONE             = 0;    
    public const UPLOADER_ERR_EMPTY_NAME       = 9001;    
    public const UPLOADER_ERR_EXT_NOT_ALLOWED  = 9002;    
    public const UPLOADER_ERR_SIZE_OVER        = 9003;    
    public const UPLOADER_ERR_FILE_EXIST       = 9004;    
    /*********************************
     * 
     * ******************************* */
    public function __construct($maxSize = null, $extensionsAllowed = null, $uniqueName = true, $prefix = '')
    {
         if ($maxSize)    $this->maxSize = $maxSize;
         if ($extensionsAllowed) $this->extensionsAllowed = $extensionsAllowed;
         
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
        if ($folder[0] != '/') $folder = '/' . $folder; 
        $this->folder = $folder;
     }
    /*********************************
     * 
     * ******************************* */
     function getPath(){
        return $this->path;
     }

    /*********************************
     * 
     * ******************************* */
     function setPath($path){
        if ($path[0] != '/') $path = '/' . $path; 
        $this->path = $path;
     }
    /*********************************
     * https://www.php.net/manual/en/features.file-upload.errors.php
     * ******************************* */
     function getErrorLib($error = -1){
        if ($error == -1) $error =  $this->lastError;
        switch($error){
            case UPLOAD_ERR_OK:                       return "{$error} - There is no error, the file uploaded with success"; break;
            case UPLOAD_ERR_INI_SIZE:                 return "{$error} - The uploaded file exceeds the upload_max_filesize directive in php.ini"; break;
            case UPLOAD_ERR_FORM_SIZE:                return "{$error} - The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; break;
            case UPLOAD_ERR_PARTIAL:                  return "{$error} - The uploaded file was only partially uploaded"; break;
            case UPLOAD_ERR_NO_FILE:                  return "{$error} - No file was uploaded"; break;
            case UPLOAD_ERR_NO_TMP_DIR:               return "{$error} - Missing a temporary folder"; break;
            case UPLOAD_ERR_CANT_WRITE:               return "{$error} - Failed to write file to disk."; break;
            case UPLOAD_ERR_EXTENSION:                return "{$error} - A PHP extension stopped the file upload."; break;
            case self::UPLOADER_ERR_NONE:             return "{$error} - Aucune erreur"; break;
            case self::UPLOADER_ERR_EMPTY_NAME:       return "{$error} - Le nom du fichier est une chaine vide"; break;
            case self::UPLOADER_ERR_EXT_NOT_ALLOWED:  return "{$error} - L'extension n'est pas rise en compte"; break;
            case self::UPLOADER_ERR_SIZE_OVER:        return "{$error} - La taille du fichier est supérieure à celle autorisée"; break;
            case self::UPLOADER_ERR_FILE_EXIST:       return "{$error} - Le fichier existe déjà"; break;
            default :                                 return "{$error} - Erreur PHP Loader"; break;
        }
     }

    /*********************************
     * 
     * ******************************* */
     function setLastError($error){
         $this->lastError = $error; 
         return $error;
     }
    /*********************************
     *  $error : tableau d'erreur numErr=>libelle de l'erreur)
     * ******************************* */
   function move_upload($arr, &$file = ''){
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
      $this->lastError = 0;
      $file = '';
      
      $tmpName  = $arr['tmp_name'];
      $fullName = $arr['name'];
      $size     = $arr['size'];
      $error    = 0; //$arr['error'];
      $type     = $arr['type'];
      
        if($error != 0) return $this->setLastError($error);
        if(!$fullName) return  $this->setLastError(self::UPLOADER_ERR_EMPTY_NAME);
    
      $h = strrpos($fullName, '.');
      $name = substr($fullName, 0, $h);
      $extension = substr($fullName,$h+1);
//echo "===>h={$h}<br>name={$name}<br>ext = {$extension}";      
      //test de validtion
        if(!in_array(strtolower($extension), $this->extensionsAllowed)) return  $this->setLastError(self::UPLOADER_ERR_EXT_NOT_ALLOWED);
        if($size > $this->maxSize) return  $this->setLastError(self::UPLOADER_ERR_SIZE_OVER);
        //--------------------------------------------------------
        switch ($this->casseExt){
            case -1 :  $extension = strtolower($extension); break;
            case  1 :  $extension = strtoupper($extension); break;
        }
        switch ($this->casseName){
            case -1 :  $name = strtolower($name); break;
            case  1 :  $name = strtoupper($name); break;
        }
        //--------------------------------------------------------
        $prefix = ($this->prefix)  ? $this->prefix . $this->sepPrefix : '';
        if ($this->uniqueName)  {
            //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
            $newName = uniqid($prefix, true);
        }else{
            $newName = $prefix . $name;
        } 


        
        //rajout de l'extension du fichier
        $file  = $newName .  '.' . $extension;
        //on renvoie le sous-dossier et le nom du fichier
        if ($this->folder)  $file = $this->folder . '/' . $file;
        
        //rejout du dossier racine du site
        if(substr($this->path,0,strlen(XOOPS_ROOT_PATH)) != XOOPS_ROOT_PATH )
              $this->path = XOOPS_ROOT_PATH  . $this->path;
        
        //creaion du dossier de destination si il n'existe pas
        if (!is_readable($this->path . $this->folder))
            mkdir($this->path . $this->folder);
            
        //$file  = $this->folder . "/" . $newName . '.' . $extension;
        $fullName = $this->path . $file;
        //echo "<hr>+++>{$tmpName}<br>===>{$fullName}<hr>";
        if (is_readable($fullName)) {
            if ($this->overwrite) {
                unlink($fullName);
            }else{
                return  $this->setLastError(self::UPLOADER_ERR_FILE_EXIST);
            }
        }
        
        move_uploaded_file($tmpName, $fullName);
        return $this->setLastError(self::UPLOADER_ERR_NONE);
   }

}

