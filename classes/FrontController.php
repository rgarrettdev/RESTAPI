<?php
/**
 * Used to set valid routes for the api and human readable pages.
 * If an api request is not valid, no view is created
 * therfore no interaction can occur with the api.
 */
$route = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$route = explode("/", $route);

if ($route[1] == '') {
    Index::createView('Index');
}
if ($route[1] == 'documentation') {
    Documentation::createView('Documentation');
}
if ($route[1] == 'about') {
    About::createView('About');
}

if ($route[1] == 'api') {
    Api::createView('Api');

    $basePath = "/api/";
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    if (strpos($path, $basePath) === 0) {
        $path = substr($path, strlen($basePath));
    }
    $path = explode("/", $path);


    $param1 = isset($path[0]) ? $path[0] : "";
    $param2 = isset($path[1]) ? $path[1] : "";
    $param3 = isset($path[2]) ? $path[2] : "";
    $param4 = isset($path[3]) ? $path[3] : "";

    switch ($param1) {

        case 'schedule':
            switch ($param2) {
                case '':
                   
                    $apiObj = new Api();
                    $apiObj->printScheduleQueryAll();
                break;

                    case 'update':
                        switch ($param3) {

                            default:
                               
                                $apiObj = new Api();
                                $_POST = json_decode(file_get_contents('php://input'), true);
                                $apiObj->updateSessionChair($_POST['chair'], $_POST['id']);
                            break;
                        }
                    break;
                    
                default:
                    
                    $apiObj = new Api();
                    $apiObj->printScheduleQuerySingle($param2);
                break;
            }
        break;
        case 'presentations':
            switch ($param2) {
                case '':
                   
                    $apiObj = new Api();
                    $apiObj->printPresentationsQueryAll();
                break;
                case 'search':
                    switch ($param3) {

                        default:
                         
                            $apiObj = new Api();
                            $apiObj->printPresentationsQuerySearch($param3);
                        break;
                    }
                break;
                case 'advanced':
                    switch ($param3) {

                        default:
                          
                            $apiObj = new Api();
                            $apiObj->printPresentationsQuerySearchWithCategory($param3, $param4);
                        break;
                    }
                break;
                case 'category':
                    switch ($param3) {

                        default:
                          
                            $apiObj = new Api();
                            $apiObj->printPresentationsQueryCategory($param3);
                        break;
                    }
                break;
                default:
                  
                    $apiObj = new Api();
                    $apiObj->printPresentationsQuerySingle($param2);
                break;
            }
        break;

            case 'login':
           
                $apiObj = new Api();
                $_POST = json_decode(file_get_contents('php://input'), true);
                $apiObj->loginRequest($_POST['email'], $_POST['password']);
            break;

            case 'logout':

                $apiObj = new Api();
                $apiObj->logout();
            break;
        
        default:
            # Shows an error message, if incorrect endpoint requested.
            echo json_encode(array( "status" => "400","message" => "Not a supported endpoint, Please consult the documentation"), JSON_PRETTY_PRINT);
            http_response_code(400);
            break;
    }
}

?>

