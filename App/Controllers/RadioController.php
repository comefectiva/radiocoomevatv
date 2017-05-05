<?php
namespace App\Controller\RadioController;

use App\Controller\Controller;
use Exception;

class RadioController extends Controller{

    public static $infoFolder = 'http://radio.coomeva.com.co/emisoras/7090/';

    public static function getAll(){
        try{
            $data = self::query("SELECT * FROM radios WHERE target='radiocoomeva'");
            return $data;
        }catch (Exception $e){
            return array('error'=>true, 'message'=>$e->getMessage(), 'code'=>$e->getCode());
        }
    }

    public static function get($id){
        try{
            $data = self::getOne("SELECT * FROM radios WHERE target='radiocoomeva' AND id=$id");
            return $data;
        }catch (Exception $e){
            return array('error'=>true, 'message'=>$e->getMessage(), 'code'=>$e->getCode());
        }
    }

    public static function getSourceInfo($filePath, $coverPath){
        $xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/'.$filePath);
        $current=$xml->current;
        $next=$xml->next;
        $history=$xml->history;

        $CurrentAlbumArt='http://radio.coomeva.com.co/emisoras/'.$coverPath.$current->album_art;
        $NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/'.$coverPath.$next->album_art;
        $data=array(
            'current'=>array(
                'title'=>(string)$current->title,
                'artist'=>(string)$current->artist,
                'duration'=>(string)$current->duration,
                'album_art'=>$CurrentAlbumArt
                //'datetime'=>$currentDatetime->format('Y-m-d H:i')
            ),
            'next'=>array(
                'title'=>(string)$next->title,
                'artist'=>(string)$next->artist,
                'duration'=>(string)$next->duration,
                'album_art'=>$NextAlbumArt,
            ),
            'prev'=>array(
                'title'=>(string)$history->title,
                'artist'=>(string)$history->artist,
                'duration'=>(string)$history->duration,
                'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/'.$coverPath.$history->album_art
                //'datetime'=>$prevDatetime->format('Y-m-d H:i')
            )
        );
        return $data;
    }
}