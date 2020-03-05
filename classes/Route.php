<?php

class Route {
    public static $validRoutes = array();
    public static $validApis = array();
    public static $validApiParam1 = array();
    public static $validApiParam2 = array();

    public static function set($route, $api, $apiParam1, $apiParam2, $function) {
        self::$validRoutes[] = $route;
        self::$validApis[] = $api;
        self::$validApiParam1[] = $apiParam1;
        self::$validApiParam2[] = $apiParam2;

            /**
            * If statments allow the api to respond depending on the condition.
            */

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if ($_GET['url'] == $route && sizeof($_GET) == 1) {
                $function->__invoke();
                http_response_code(200);
            } elseif ($_GET['url'] == $route && $_GET['api'] == $api && sizeof($_GET) == 2) {
                    $function->__invoke();
                    http_response_code(200);
            } elseif ($_GET['url'] == $route && $_GET['api'] == $api && sizeof($_GET) == 3) {
                $function->__invoke();
                http_response_code(200);
                //Improve the error clause
            } elseif($_GET['url'] !== $route) {
               // http_response_code(404);
            } 
        } 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "POST";
        }
        //Add else if for response
         else {
          //  http_response_code(405);
        }
    }
}

?>