<?php
class Api extends Controller
{
    //TODO:: ADD COMMENTS ABOUT EACH SELECT STATEMENT!
    public static function printMasterQuery()
    {
        //   print_r(Database::query("SELECT name FROM sqlite_master where type='table'"));
    }
    /**
     * Prints the query for /api/schedule/
     */
    public function printScheduleQueryAll()
    {
        $sqlQuery = "SELECT * FROM 'sessions' s INNER JOIN 'slots' sl ON s.slotsID=sl.id";
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery);
        echo $response;
    }
    /**
     * Prints the query for /api/schedule/:id
     */
    public function printScheduleQuerySingle($apiOpt1)
    {
        $scheduleID = self::test_input($apiOpt1);
        $sqlQuery = "SELECT s.title, s.description, s.chair, s.room, sl.day, sl.time, pap_auth.id FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id  INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
        WHERE sl.id=:id";
        $params = [ ':id' => $scheduleID ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        print_r($response);
    }
    /**
     * Prints the query for /api/presentations/
     */
    public function printPresentationsQueryAll()
    {
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
        INNER JOIN authors auth ON pap_auth.authorID = auth.authorID";
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery);
        echo $response;
    }
    /**
     * Prints the query for /api/presentations/:id
     */
    public function printPresentationsQuerySingle($apiOpt1)
    {
        $slotsID = self::test_input($apiOpt1);
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id  INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
        INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
         WHERE pap_auth.id=:id";
        $params = [ ':id' => $slotsID];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    public function printShowAllCatrgories()
    {
        print_r(Database::query("SELECT DISTINCT type FROM 'sessions'"));
    }
    /**
     * Prints the query for /api/presentations/search/:term
     */
    public function printPresentationsQuerySearch($apiOpt1)
    {
        $searchType = self::test_input($apiOpt1);

        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a
         INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
         INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
         WHERE a.title LIKE :title OR a.abstract LIKE :abstract";

        $params = [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%'  ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
     * Prints the query for /api/presentations/search/:term/category/:cat
     */
    public function printPresentationsQuerySearchWithCategory($apiOpt1, $apiOpt2)
    {
        $searchType = self::test_input($apiOpt1);
        $sessionType = self::test_input($apiOpt2);
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a
         INNER JOIN 'sessions' s  ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
         INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
         WHERE (a.title LIKE :title OR a.abstract LIKE :abstract) AND s.type=:sessionType";
        $params = [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%', ':sessionType' => $sessionType];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
    * Prints the query for /api/presentations/category/:cat
    */
    public function printPresentationsQueryCategory($apiOpt2)
    {
        $sessionType = self::test_input($apiOpt2);
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.type, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a 
        INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
         INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
        WHERE s.type=:sessionType";
        $params = [ 'sessionType' => $sessionType ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
    * Prints the query for /api/login/
    */
    public function loginRequest($loginApiUser)
    {
        $email = self::test_input($loginApiUser);
        print_r(Database::loginRequest("SELECT * FROM users WHERE email=:email", [ ':email' => $email ]));
    }
    /**
     * Prints the query for /api/login/
     */

    public function updateSessionChair($updateRequestBody, $updateID)
    {
        $data = self::test_input($updateRequestBody);
        $id = self::test_input($updateID);
        if (!isset($_COOKIE['user'])) {
            echo json_encode(array( "message" => "Cookie not set"), JSON_PRETTY_PRINT);
        } else {
            try {
                $decoded = JWT::decode($_COOKIE['user'], ApplicationRegistry::getSecretKey());
                if ($decoded->admin == 1) {
                    Database::query("UPDATE 'sessions' SET chair=:chair WHERE id=:id", [ ':chair' => $data, ':id' => $id ]);
                    echo json_encode(array( "message" => "Successfully updated Session Chair"), JSON_PRETTY_PRINT);
                    http_response_code(200);
                } else {
                    echo json_encode(array( "message" => "Only admin can change values!"), JSON_PRETTY_PRINT);
                    http_response_code(401);
                }
            } catch (Exception $e) {
                echo json_encode(array( "message" => "Access Denied", "error" => $e->getMessage()), JSON_PRETTY_PRINT);
                http_response_code(401);
            }
        }
    }

    protected function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
