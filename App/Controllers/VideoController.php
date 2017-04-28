<?php

namespace App\Controllers\VideoController;

use App\Controller\Controller;
use Exception;

class VideoController extends Controller{

    function __construct(){
        header('Content-type: application/json');
    }

    public static function getAll(){
        $videos = self::query("SELECT id,name,image,video,url,sector,requireLogin,created_at FROM videos");
        return json_encode($videos);
    }

    public static function getVideo($id){
        $video = self::getOne("SELECT id,name,image,video,url,sector,requireLogin,created_at FROM videos WHERE id=$id");
        return json_encode($video);
    }

    public static function createVideo(Array $params){
        try{
            $video = self::save("INSERT INTO `videos`(`name`, `image`, `video`, `url`, `sector`, `requireLogin`)
                                        VALUES (:name, :image, :video, :url, :sector, :requireLogin)", $params);
            return array("error"=> false, "video"=>$video);
        }catch (Exception $e){
            return array('error' => true, 'message'=>$e->getMessage());
        }
    }

    public static function updateVideo(Array $params){
        try{
            $video = self::update("UPDATE `videos` 
                                   SET `name`=:name, `image`=:image, `video`=:video, `url`=:url, `sector`=:sector, `requireLogin`=:requireLogin
                                   WHERE id=:id", $params);
            return array("error"=> false, "video"=>$video);
        }catch (Exception $e){
            return array('error' => true, 'message'=>$e->getMessage());
        }
    }

    public static function deleteVideo(Array $params){
        try{
            $video = self::update("DELETE FROM `videos` WHERE `id`=:id", $params);
            return array("error"=> false, "video"=>$video);
        }catch (Exception $e){
            return array('error' => true, 'message'=>$e->getMessage());
        }
    }
}