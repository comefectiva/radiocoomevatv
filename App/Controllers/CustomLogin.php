<?php
namespace App\Controllers\CustomLogin;

use App\Controller\Controller;
use Exception;
use League\Csv\Reader;

class CustomLogin extends Controller{

    private static $DBFolder;
    private static $DBFileName;

    function __construct(){
        self::$DBFolder = $_SERVER['DOCUMENT_ROOT'].'/DB/';
        header('Content-Type: application/json');
    }

    public static function saveUserListFile($file){
        $acceptedFiles = array('text/plain','text/csv');

        $upload = self::uploadFile($file, 'csv', self::$DBFolder, $acceptedFiles, '10M');
        self::$DBFileName = $upload['name'];
        return $upload;
    }

    public static function fillUserList($post){
        try{
            //load the CSV document from a file path
            $csv = Reader::createFromPath(self::$DBFolder.self::$DBFileName);
            $records = $csv->fetchAll(); //RETURNS AN ARRAY WITH THE CSV OBJECTS
            $users = array();
            $errors = array();
            //var_dump($records);
            foreach ($records as $record){
                $params = array('video'=>$post['video'],
                    'user'=>$record[0], 'location'=>$record[1],
                    "pass"=>password_hash($post['pass'], PASSWORD_DEFAULT));
                $user = self::save("INSERT INTO customLogin(`video`, `user`, `pass`, `location`) 
                                       VALUES (:video, :user, :pass, :location)", $params);
                if($user){
                    $params[] = $user;
                    $users[] = array("id"=>$user, $params);
                }else{
                    $errors[] = array('error'=>true);
                }
            }
            return array("error"=>false, "errors"=>$errors);
        }catch (Exception $e){
            return array("error" =>true, "message"=>$e->getMessage());
        }
    }

    public static function getByUser($user){
        try{
            $data = self::getOne("SELECT * FROM customLogin WHERE user='$user'");
            if(count($data)>1){
                return array('error'=>false, $data, 'message'=>'Exitoso', 'count'=>count($data));
            }else{
                return array('error'=>true, $data, 'message'=>'Inválido');
            }
        }catch (Exception $e){
            return array('error'=>true, 'message'=>$e->getMessage());
        }
    }


}