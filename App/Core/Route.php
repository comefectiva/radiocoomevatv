<?php
namespace App\Core\Route;
use App\Middlewares\Auth\Auth;

/**
 * We need to import the VideoController to Invoke the Index view method
 */

use App\Controllers\HomeController\HomeController;

/**
 * Class Route
 * @package App\Core\Route
 */
class Route{

    /**
     * @var array
     */
    public static $validGETRoutes = array();
    public static $validPOSTRoutes = array();
    public static $validPUTRoutes = array();
    public static $response = NULL;


    /**
     * Render the App and display the response
     * If there are not a response then display the frontEnd for the route handling
     */
    public static function render(){
        if(self::$response === NULL){
            echo HomeController::CreateView('Index');
        }else{
            echo self::$response;
        }
        die();
    }

    /**
     * function for GET methods
     * @param $route = String with route
     * @param $function = function for this route
     * @param $requireAuth = Array with auth options
     */
    public static function get($route, $function, $requireAuth){
        self::$validGETRoutes[] = $route;
        //Request matching
        $match = explode('?', $_SERVER['REQUEST_URI']);
        if($match[0] == $route && $_SERVER['REQUEST_METHOD'] === 'GET'){
            if($requireAuth['requireAuth'] === false){
                self::$response = $function->__invoke();
            }else{
                if(Auth::Check($_SERVER['Authorization'])){
                    self::$response = $function->__invoke();
                }else{
                    http_response_code(401);
                }
            }
        }
    }

    /**
     * function for POST methods
     * @param $route = String with route
     * @param $function = function for this route
     * @param $requireAuth = Array with auth options
     */
    public static function post($route, $function, $requireAuth){
        self::$validPOSTRoutes[] = $route;
        if($_SERVER['REQUEST_URI'] == $route && $_SERVER['REQUEST_METHOD'] === 'POST'){
            if($requireAuth['requireAuth'] === false){
                self::$response = $function->__invoke();
            }else{
                // When require authentication
            }
        }
    }

    /**
     * function for PUT methods
     * @param $route = String with route
     * @param $function = function for this route
     * @param $requireAuth = Array with auth options
     */
    public static function put($route, $function, $requireAuth){
        self::$validPUTRoutes[] = $route;
        if($_SERVER['REQUEST_URI'] == $route && $_SERVER['REQUEST_METHOD'] === 'PUT'){
            if($requireAuth['requireAuth'] === false){
                self::$response = $function->__invoke();
            }else{
                if(Auth::Check($_SERVER['Authorization'])){
                    self::$response = $function->__invoke();
                }else{
                    http_response_code(401);
                }
                // when require authentication
            }
        }
    }

    /**
     * function for PUT methods
     * @param $route = String with route
     * @param $function = function for this route
     * @param $requireAuth = Array with auth options
     */
    public static function delete($route, $function, $requireAuth){
        self::$validPUTRoutes[] = $route;
        if($_SERVER['REQUEST_URI'] == $route && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            if($requireAuth['requireAuth'] === false){
                self::$response = $function->__invoke();
            }else{
                if(Auth::Check($_SERVER['Authorization'])){
                    self::$response = $function->__invoke();
                }else{
                    http_response_code(401);
                }
                // when require authentication
            }
        }
    }
}