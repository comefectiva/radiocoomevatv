<?php
namespace App\Middlewares\Auth;
use Exception;
use Firebase\JWT\JWT;

/**
 * Class Auth
 * @package App\Middlewares\Auth
 */
class Auth{

    private static $encrypt = ['HS256'];
    private static $secretKey = '$2a$10$Mg8TR4MJN85f7VVSiVroIuiyngbZEpT2ZB1hgwt2aG4w8RAG5ZN0y';
    private static $aud = null;

    /**
     * @param $data = Array with user info
     * @return array = Array with JWT Token
     */
    public static function SignIn($data){
        $time = time();

        $token = array(
            'exp' => $time + (60*60),
            'aud' => self::Aud(),
            'data' => $data
        );

        $jwt = JWT::encode($token, self::$secretKey);
        return array("token"=>$jwt, "errors"=>false);
    }

    /**
     * @param $token
     * @return bool
     * @throws Exception
     */
    public static function Check($token){
        if(empty($token)) {
            throw new Exception("El Token suministrado es invalido.");
        }

        $decode = JWT::decode(
            $token,
            self::$secretKey,
            self::$encrypt
        );

        if($decode->aud !== self::Aud()) {
            throw new Exception("El usuario es invalido.");
        }
        return true;
    }

    public static function GetData($token){
        return JWT::decode(
            $token,
            self::$secretKey,
            self::$encrypt
        )->data;
    }


    /**
     * @return string
     */
    private static function Aud(){
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}