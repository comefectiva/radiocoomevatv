<?php

namespace App\Controllers\UserController;

use App\Controller\Controller;
use App\Middlewares\Auth\Auth;

class UserController extends Controller{

    /**
     * @param $data = $_POST data info
     * @return array = Array with Token info
     */
    public static function login($data){
        $user = self::getOne("SELECT mail,password FROM users WHERE mail='".$data['mail']."'");
        if(count($user)<=0 || !password_verify($data['password'], $user['password'])){
            return array('error'=>401, 'message'=>'Información inválida.');
        }else{
            header('Content-type: application/json');
            return Auth::SignIn($data);
        }
    }

    /**
     * GET all Users in JSON format
     */
    public static function getAll(){
        $users = self::query("SELECT id,name,mail,isAdmin,created_at FROM users");
        header('Content-type: application/json');
        return json_encode($users);
    }
}