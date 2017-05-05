<?php
namespace App\Controller\PodcastController;

use App\Controller\Controller;

class PodcastController extends Controller{

    public static function getAll(){
        return self::OldQuery('SELECT * FROM phi_podcast');
    }

    public static function getOne($id){
        return self::OldOne("SELECT * FROM phi_podcast WHERE id=$id");
    }
}