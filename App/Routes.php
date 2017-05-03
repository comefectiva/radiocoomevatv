<?php
namespace App\Routes;


error_reporting(E_ALL);

use App\Controllers\CustomLogin\CustomLogin;
use App\Controllers\HomeController\HomeController;
use App\Controllers\MediaController\MediaFileController;
use App\Controllers\UserController\UserController;
use App\Controllers\VideoController\VideoController;
use App\Core\Route\Route;

//Create new Route Handler
$route = new Route();

//App Routes, if you want to create a new route please use relative paths (like /route/to/create)

$route::get('/', function(){
    echo HomeController::CreateView('Index');
}, array('requireAuth' => false));

// API ROUTES
$route::post('/api/login', function(){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);

    header('Content-Type: application/json');
    return json_encode(UserController::login($data));
}, array('requireAuth' => false));

//Get Users
$route::get('/api/users', function(){
    return UserController::getAll();
}, array('requireAuth' => true));
//Create User
$route::post('/api/users', function(){
    return UserController::getAll();
}, array('requireAuth' => true));


/**
 * API FOR VIDEOS
 * THIS API ALLOW METHODS GET POST PUT DELETE
 * The GET method must specify which king os result need
 * if u need a single row need to send the param `id`
 * if u need the entire list of videos just do the raw request
 */
$route::get('/api/videos', function(){
    if(isset($_GET['id'])){
        return VideoController::get($_GET['id']);
    }else{
        return VideoController::getAll();
    }
}, array('requireAuth' => false));
$route::get('/api/videos/url', function(){
    if(isset($_GET['url'])){
        return VideoController::getByUrl($_GET['url']);
    }else{
        return json_encode(array('error'=>true, 'message'=>'Debes especificar una URL'));
    }
}, array('requireAuth' => false));
$route::post('/api/videos', function(){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    $video = VideoController::createVideo($data);
    return json_encode($video);
}, array('requireAuth' => false));
$route::put('/api/videos', function(){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    $video = VideoController::updateVideo($data);
    return json_encode($video);
}, array('requireAuth' => false));
$route::delete('/api/videos', function(){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    $video = VideoController::deleteVideo($data);
    return json_encode($video);
}, array('requireAuth' => false));

/**
 * API FOR CustomLogin
 * THIS API ALLOW METHODS GET POST
 * The GET method must specify which king os result need
 * if u need a single row need to send the param `id`
 * if u need the entire list of videos just do the raw request
 */
$route::get('/api/custom-login', function(){
    echo VideoController::getAll();
}, array('requireAuth' => false));
$route::post('/api/custom-login', function(){
    $customLogin = new CustomLogin();
    $result = array("error"=>false);
    if($result['uploadFile'] = $customLogin::saveUserListFile('csv')):
        if($result['uploadFile']['error'] === false):
            if($result['fillUsers'] = $customLogin::fillUserList($_POST)):
                if($result['fillUsers']['error'] === true):
                    $result['error'] = true;
                endif;
            endif;
        else:
            $result['error'] = true;
        endif;
    else:
        $result = array("error"=>true, 'message'=>'No se ha subido ningún archivo.');
    endif;
    return json_encode($result);
}, array('requireAuth' => false));

/**
 * API FOR MediaFiles
 * THIS API ALLOW METHODS GET POST
 * The GET method must specify which king os result need
 * if u need a single row need to send the param `id`
 * if u need the entire list of videos just do the raw request
 */
$route::get('/api/media', function(){
    $media = MediaFileController::get($_GET['id']);
    return json_encode($media);
}, array('requireAuth' => false));
$route::post('/api/media', function(){
    $MediaFile = new MediaFileController();
    $result = array("error"=>false);
    if($result['uploadFile'] = $MediaFile::saveMediaFile('media')):
        if($result['uploadFile']['error'] === false):
            $result['media'] = $MediaFile::createMediaFile();
        else:
            $result['error'] = true;
        endif;
    else:
        $result = array("error"=>true, 'message'=>'No se ha subido ningún archivo.');
    endif;
    return json_encode($result);
}, array('requireAuth' => false));

$route::render();