<?php
namespace App\Controllers\MediaController;

use App\Controller\Controller;
use Exception;

class MediaFileController extends Controller{

    private static $ImagesFolder;
    private static $VideosFolder;
    private static $CurrentMediaName;
    private static $CurrentMediaPath;

    function __construct(){
        header('Content-type: application/json');
        self::$ImagesFolder = $_SERVER['DOCUMENT_ROOT'].'/images/';
        self::$VideosFolder = $_SERVER['DOCUMENT_ROOT'].'/videos/';
    }

    public static function get($id){
        $media = self::query("SELECT id,name,type,created_at FROM media WHERE id=$id");
        return $media;
    }

    public static function saveMediaFile($file){
        try{
            if(fnmatch('image/*', $_FILES[$file]['type'])){
                $acceptedFiles = array('image/gif','image/jpeg','image/png');
                $folder = self::$ImagesFolder;
                $maxStorage = '5M';
                self::$CurrentMediaPath = self::$ImagesFolder;
            }else if(fnmatch('video/*', $_FILES[$file]['type'])){
                $acceptedFiles = array('video/mp4','video/ogg','video/webm');
                $folder = self::$VideosFolder;
                $maxStorage = '500M';
                self::$CurrentMediaPath = self::$VideosFolder;
            }else{
                return array("error"=>true, "message"=>"No ha subido un tipo de archivo valido");
            }
            $path = $_FILES[$file]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $upload = self::uploadFile($file, $ext, $folder, $acceptedFiles, $maxStorage);
            self::$CurrentMediaName = $upload['name'].'.'.$ext;
            return $upload;
        }catch (Exception $e){
            return array("error"=>true, "message"=>$e->getMessage());
        }
    }

    public static function createMediaFile(){
        try{
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE); // devuelve el tipo mime de su extensión
            $type = finfo_file($fileInfo, self::$CurrentMediaPath.'.'.self::$CurrentMediaName);
            finfo_close($fileInfo);
            $params = array('name'=>self::$CurrentMediaName, 'type'=>$type);
            $media = self::save("INSERT INTO media(name,type) VALUES (:name, :type)", $params);
            return array("error"=>false, "id"=>$media);
        }catch (Exception $e){
            return array('error'=>true, "message"=>$e->getMessage());
        }
    }
}