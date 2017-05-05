<?php
namespace App\Controller\Top10;

use App\Controller\Controller;
use Exception;

class Top10Controller extends Controller{

    public static function getAll($radio){
        try{
            $data = self::OldQuery("SELECT * FROM mp3s WHERE lista='$radio' AND estado='1'");
            return $data;
        }catch (Exception $e){
            return array('error'=>true, 'message'=>$e->getMessage(), 'code'=>$e->getCode());
        }
    }

    public static function get($id){
        try{
            $data = self::getOne("SELECT * FROM mp3s WHERE target='radiocoomeva' AND id=$id");
            return $data;
        }catch (Exception $e){
            return array('error'=>true, 'message'=>$e->getMessage(), 'code'=>$e->getCode());
        }
    }
}