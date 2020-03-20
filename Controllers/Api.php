<?php
class Api extends Controller {
    //TODO:: ADD COMMENTS ABOUT EACH SELECT STATEMENT!
    public static function printMasterQuery() {
        print_r(Database::query("SELECT name FROM sqlite_master where type='table'"));
    }
    public static function printScheduleQueryAll() {
        print_r(Database::query("SELECT * FROM 'sessions'"));
       
    }
    public static function printScheduleQuerySingle($apiOpt1) {
        $scheduleID = self::test_input($apiOpt1);
        print_r(Database::query("SELECT * FROM 'sessions' WHERE id=:id",[ ':id' => $scheduleID ]));
       
    }
    public static function printPresentationsQueryAll() {
        print_r(Database::query("SELECT * FROM activities"));
    }
    public static function printShowAllCatrgories() {
        print_r(Database::query("SELECT DISTINCT type FROM 'sessions'"));
    }
    public static function printPresentationsQuerySearch($apiOpt1) {
        $searchType = self::test_input($apiOpt1);
        print_r(Database::query("SELECT * FROM activities WHERE title LIKE :title OR abstract LIKE :abstract",
        [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%'  ]));
    }
    public static function printPresentationsQuerySearchWithCategory($apiOpt1, $apiOpt2) {
        $searchType = self::test_input($apiOpt1);
        $sessionType = self::test_input($apiOpt2);
        print_r(Database::query("SELECT e.*, s.type FROM activities e INNER JOIN 'sessions' s ON e.sessionsID=s.id
         WHERE (e.title LIKE :title OR e.abstract LIKE :abstract) AND s.type=:sessionType",
          [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%', ':sessionType' => $sessionType]));
    }
    public static function printPresentationsQueryCategory($apiOpt2) {
        $sessionType = self::test_input($apiOpt2);
        print_r(Database::query("SELECT e.*, s.type FROM activities e INNER JOIN 'sessions' s ON e.sessionsID=s.id
        WHERE s.type=:sessionType", [ 'sessionType' => $apiOpt2]));
    }
    public static function loginRequest($loginApiUser) {
        $email = self::test_input($loginApiUser);
        print_r(Database::loginRequest("SELECT * FROM users WHERE email=:email",[ ':email' => $email ]));
    }

    public static function updateSessionChair($updateRequestBody, $updateID) {
        $data = self::test_input($updateRequestBody);
        $id = self::test_input($updateID);
        if (!isset($_COOKIE['user'])) {
            echo json_encode(array( "message" => "Cookie not set"),JSON_PRETTY_PRINT);
        } else {

           try {
               $decoded = JWT::decode($_COOKIE['user'], ApplicationRegistry::getSecretKey());
               if ($decoded->admin == 1) {
                    Database::query("UPDATE 'sessions' SET chair=:chair WHERE id=:id",[ ':chair' => $data, ':id' => $id ]);
                    echo json_encode(array( "message" => "Successfully updated Session Chair"),JSON_PRETTY_PRINT);
                    http_response_code(200);
               } else {
                   echo json_encode(array( "message" => "Only admin can change values!"),JSON_PRETTY_PRINT);
                   http_response_code(401);
               }
           } catch (Exception $e) {
            echo json_encode(array( "message" => "Access Denied", "error" => $e->getMessage()),JSON_PRETTY_PRINT);
            http_response_code(401);
           }
        }
    }

    protected function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>