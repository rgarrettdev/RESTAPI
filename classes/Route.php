<?php

class Route
{
    public static $validRoutes = array();
    public static $validApis = array();

    public static function set($route, $api, $function)
    {
        self::$validRoutes[] = $route;
        self::$validApis[] = $api;

        $apiObj = new Api();

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
                    $function->__invoke();
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
                    $function->__invoke();
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
                    $function->__invoke();
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
         * POST.
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $loginApiEmail = $_POST['email'];
            $loginApiPass = $_POST['password'];
            $apiObj->loginRequest($_POST['email'], $_POST['password']);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            if ($_GET['url'] == $route && $_GET['api'] == $api && isset($_GET['apiParam1']) == true && isset($_GET['apiParam2']) == true && sizeof($_GET) == 4) {
                $apiOpt1 = $_GET['apiParam1'];
                $apiOpt2 = $_GET['apiParam2'];
                if ($api == 'schedule' && $apiOpt1 == 'update') {
                    $_PUT = self::putParse();
                    $apiObj->updateSessionChair($_PUT['sessionChair'], $apiOpt2);
                }
            }
        }
    }
    //TODO: ADD CLAUSES FOR OTHER HEADER TYPES!!

    /**
     * This function parses put header. PHP has no built in $_PUT
     */
    protected static function putParse()
    {
        parse_str(file_get_contents("php://input"), $_PUT);
        foreach ($_PUT as $key => $value) {
            unset($_PUT[$key]);
            $_PUT[str_replace('amp;', '', $key)] = $value;
            /**
             * Content type needs to be specified as when PUT header is parsed in Route.php, content type reverts to default settings.
             */
            header("Content-Type: application/json; charset=UTF-8");
        }
        return $_PUT;
    }
}
