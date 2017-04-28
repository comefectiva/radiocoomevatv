<?php
namespace App;
//Require external libs
require_once '../../vendor/autoload.php';
require_once '../Routes.php';

//Load Initial Scripts
/**
 * @param $class_name
 */
function __autoload($class_name){
    if(file_exists('../Core/'.$class_name.'.php')){ //Load Main Core
        require_once '../Core/'.$class_name.'.php';
    }else if(file_exists('./Controllers/'.$class_name.'.php')){ //Load Controllers
        require_once '../Controllers/'.$class_name.'.php';
    }
}