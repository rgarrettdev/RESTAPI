<?php

class Route
{
    public static $validRoutes = array();
    public static $validApis = array();
    public static function set($route, $api, $function)
    {
        self::$validRoutes[] = $route;
        self::$validApis[] = $api;

        /**
         * __invoke() exectutes the functions in the front controller, creating the view for a given route.
         * If an given request, asks for a route(url) that is not defined in the front controller,
         * nothing can be returned as it is an invalid route.
         */

        if ($_GET['url'] == $route) {
            $function->__invoke();
            self::setRequest($route, $api);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::setRequest($route, $api);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::setRequest($route, $api);
        }
    }

    public static function setRequest($route, $api)
    {
        $apiObj = new Api();

        /**
         * If statments allow the api to respond depending on the condition.
         */

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            /**
             *
             * This check allows for full control of the api,
             * so if a dev accidentally added more path paramaters that 5 an error is returned.
             *
             */
            $url = $_SERVER['REQUEST_URI'];
            $url = parse_url($url, PHP_URL_PATH);
            $slashcount = substr_count($url, '/');

            if ($slashcount <= 5) {
                /**
                 * Checks if url is a valid route, and the get header is of size 1
                 * Then executes the function . This can be seen in FrontController.php
                 * This if statement is used for testing purposes.
                 */
                if ($_GET['url'] == $route && sizeof($_GET) == 1) {
                    // $apiObj->printMasterQuery();
                    http_response_code(200);
                /**
                 * Checks if url is a valid route, then checks if api is valid. The get header is size of 2.
                 * Then executes the function. This can be seen in FrontController.php
                 */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && sizeof($_GET) == 2) {
                    if ($_GET['api'] == 'logout') {
                        $apiObj->logout();
                    }
                    http_response_code(200);
                /**
                 * Does the normal checks, also with if the apiParam has been set and get header is size of 3.
                 * Look at .htaccess to see the url params.
                 * Futher checks on what api to call and execute specfic queries based on what api is called.
                 */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && sizeof($_GET) == 3) {
                    $apiOpt1 = $_GET['apiParam1'];
                    
                    http_response_code(200);
                    if ($apiOpt1 != null && $api == 'schedule') {
                        $apiObj->printScheduleQuerySingle($apiOpt1);
                    } elseif ($apiOpt1 == null && $api == 'schedule') {
                        $apiObj->printScheduleQueryAll();
                    } elseif ($apiOpt1 == null && $api == 'presentations') {
                        $apiObj->printPresentationsQueryAll();
                    } elseif ($apiOpt1 != null && $api == 'presentations') {
                        $apiObj->printPresentationsQuerySingle($apiOpt1);
                    } else {
                        echo("ERROR: NOT SUPPORTED ENDPOINT");
                        http_response_code(405);
                    }
                    /**
                     * Normal checks, now with an another apiParam called apiParam2.
                     * Checks what api options have been used to either search/category.
                     * Executed specfic queries based on what condition is met.
                     */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && isset($_GET['apiParam2']) == true && sizeof($_GET) == 4) {
                    $apiOpt1 = $_GET['apiParam1'];
                    $apiOpt2 = $_GET['apiParam2'];
                    
                    if ($apiOpt1 == 'search') {
                        $apiObj->printPresentationsQuerySearch($apiOpt2);
                    } elseif ($apiOpt1 == 'category' && $apiOpt2 == null) {
                        $apiObj->printShowAllCatrgories();
                    } elseif ($apiOpt1 == 'category') {
                        $apiObj->printPresentationsQueryCategory($apiOpt2);
                    }
                    http_response_code(200);
                /**
                 * This elseif allows for a futher apiParam that allows the search api to filter by category.
                 *
                 * An example of this call would be: localhost/api/presentations/search/virtual/paper
                 */
                } elseif ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && isset($_GET['apiParam2']) == true
                 && isset($_GET['apiParam3']) == true && sizeof($_GET) == 5) {
                    $apiOpt1 = $_GET['apiParam1'];
                    $apiOpt2 = $_GET['apiParam2'];
                    $apiOpt3 = $_GET['apiParam3'];
                    
                    if ($apiOpt1 == 'search') {
                        $apiObj->printPresentationsQuerySearchWithCategory($apiOpt2, $apiOpt3);
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
         * POST request, checks if post id empty if true parses input to the
         * associative array $_POST.
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $apiObj->loginRequest($_POST['email'], $_POST['password']);
        }
        /**
         * PUTT request,
         * $_POST used as there are no native $_PUT associative arrays.
         */
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $apiObj->updateSessionChair($_POST['chair'], $_POST['id']);
        }
    }
}
