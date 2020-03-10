<?php
class Api extends Controller {
    //TODO:: ADD COMMENTS ABOUT EACH SELECT STATEMENT!
    public static function printMasterQuery() {
        echo(Database::query("SELECT name FROM sqlite_master where type='table'"));
    }
    public static function printScheduleQueryAll() {
        echo(Database::query("SELECT * FROM 'sessions'"));
       
    }
    public static function printScheduleQuerySingle($apiOpt1) {
        $scheduleID = self::test_input($apiOpt1);
        echo(Database::query("SELECT * FROM 'sessions' WHERE id=:id",[ ':id' => $scheduleID ]));
       
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
    public static function loginQuery($loginApiUser,$loginApiPassword) {
        $email = self::test_input($loginApiUser);
        print_r(Database::loginQuery("SELECT * FROM users WHERE email=:email",[ ':email' => $email ]));
    }

    public static function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>