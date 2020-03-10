<?php

class Route {
    public static $validRoutes = array();
    public static $validApis = array();

    public static function set($route, $api, $function) {
        self::$validRoutes[] = $route;
        self::$validApis[] = $api;

            /**
             * If statments allow the api to respond depending on the condition.
             */

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            /**
             * 
             * This check allows for full control of the api,
             * so if a dev accidentally added more path paramaters an error is returned.
             * 
             */
            $url = $_SERVER['REQUEST_URI'];
            $url = parse_url($url, PHP_URL_PATH);
            $slashcount = substr_count($url, '/');

            if ($slashcount <= 5) {
                /**
                 * Checks if url is a valid route, and the get header is of size 1
                 * Then executes the function via invoke. This can be seen in FrontController.php
                 */
                if ($_GET['url'] == $route && sizeof($_GET) == 1) {
                    $function->__invoke();
                    http_response_code(200);
                /**
                 * Checks if url is a valid route, then checks if api is valid. The get header is size of 2.
                 * Then executes the function via invoke. This can be seen in FrontController.php
                 */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && sizeof($_GET) == 2) {
                    $function->__invoke();
                    http_response_code(200);
                /**
                 * Does the normal checks, also with if the apiParam has been set and get header is size of 3.
                 * Look at .htaccess to see the url params.
                 * Futher checks on what api to call and execute specfic queries based on what api is called.
                 */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && sizeof($_GET) == 3) {
                    $apiOpt1 = $_GET['apiParam1'];
                    $function->__invoke();
                    http_response_code(200);
                    if ($apiOpt1 != NULL && $api == 'schedule') {
                        Api::printScheduleQuerySingle($apiOpt1);
                    } elseif ($apiOpt1 == NULL && $api == 'schedule') {
                        Api::printScheduleQueryAll();
                    } elseif ($apiOpt1 == NULL && $api == 'presentations') {
                        Api::printPresentationsQueryAll();
                    } else {
                        echo("ERROR: NOT SUPPORTED ENDPOINT");
                        http_response_code(405);
                    }
                /**
                 * Normal checks, now with an another apiParam called apiParam2.
                 * Checks what api options have been used to either search/category.
                 * Executed specfic queries based on what condition is met.
                 */
                } elseif($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && isset($_GET['apiParam2']) == true && sizeof($_GET) == 4) {
                    $apiOpt1 = $_GET['apiParam1'];
                    $apiOpt2 = $_GET['apiParam2'];
                    $function->__invoke();
                    if ($apiOpt1 == 'search') {
                        Api::printPresentationsQuerySearch($apiOpt2);
                    } elseif ($apiOpt1 == 'category' && $apiOpt2 == NULL) {
                        Api::printShowAllCatrgories();
                    } elseif ($apiOpt1 == 'category') {
                        Api::printPresentationsQueryCategory($apiOpt2);
                    }
                    http_response_code(200);
                /**
                 * This elseif allows for a futher apiParam that allows the search api to filter by category. 
                 *                                          
                 * An example of this call would be: localhost/api/presentations/search/virtual/paper
                 */
                } elseif($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && isset($_GET['apiParam2']) == true
                 && isset($_GET['apiParam3']) == true && sizeof($_GET) == 5) {
                    $apiOpt1 = $_GET['apiParam1'];
                    $apiOpt2 = $_GET['apiParam2'];
                    $apiOpt3 = $_GET['apiParam3'];
                    $function->__invoke();
                    if ($apiOpt1 == 'search') {
                        Api::printPresentationsQuerySearchWithCategory($apiOpt2, $apiOpt3);
                    } elseif ($apiOpt1 == 'category') {
                        echo("ERROR: TOO MANY ENDPOINT ARGUMENTS");
                        http_response_code(405);
                    }
                    http_response_code(200);
                }
            } else {
             /**
              * Echo error to the endpoint.
              * 
              */
                echo("ERROR: TOO MANY ENDPOINT ARGUMENTS");
                http_response_code(405);
            }
        }
        /**
         * POST.
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && sizeof($_GET) == 3) {
                $apiOpt1 = $_GET['apiParam1'];
                $loginApiEmail = $_POST['email'];
                $loginApiPassword = $_POST['password'];
                $function->__invoke();
                http_response_code(200);
                if ($apiOpt1 == NULL && $api == 'login') {
                    Api::loginQuery($loginApiEmail,$loginApiPassword);
                    http_response_code(200);
                }  else {
                    echo("ERROR: NOT SUPPORTED POST ENDPOINT");
                    http_response_code(405);
                }
            }
        }
    }
    //TODO: ADD CLAUSES FOR OTHER HEADER TYPES!!
}

?>