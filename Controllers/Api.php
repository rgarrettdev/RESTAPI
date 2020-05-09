<?php
class Api extends Controller
{
    //TODO:: ADD COMMENTS ABOUT EACH SELECT STATEMENT!
    public static function printMasterQuery()
    {
        $sqlQuery = "SELECT * FROM 'sessions'";
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery);
        print_r($response);
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
     * @param $apiOpt1 is the schedule id
     */
    public function printScheduleQuerySingle($apiOpt1)
    {
        $scheduleID = self::test_input($apiOpt1);
        $sqlQuery = "SELECT a.title, s.description, s.chair, s.room, sl.day, sl.time, pap_auth.id FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id
          INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id 
        WHERE sl.id=:id";
        $params = [ ':id' => $scheduleID ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
     * Prints the query for /api/presentations/
     */
    public function printPresentationsQueryAll()
    {
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
        INNER JOIN authors auth ON pap_auth.authorID = auth.authorID WHERE s.type!='break' AND s.type!='miscellaneous' ";
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery);
        echo $response;
    }
    /**
     * Prints the query for /api/presentations/:id
     * @param $apiOpt1 is the id of the presentation.
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
     * @param $apiOpt1 is the search term used to filter the presentations.
     */
    public function printPresentationsQuerySearch($apiOpt1)
    {
        $searchType = self::test_input($apiOpt1);

        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a
         INNER JOIN 'sessions' s ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
         INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
         WHERE a.title LIKE :title OR a.abstract LIKE :abstract AND s.type!='break' AND s.type!='miscellaneous'";

        $params = [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%'  ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
     * Prints the query for /api/presentations/search/:term/category/:cat
     * @param $apiOpt1 is the search term used to filter the presentations.
     * @param $apiOpt2 is the session type used to filter the presentations.
     */
    public function printPresentationsQuerySearchWithCategory($apiOpt1, $apiOpt2)
    {
        $searchType = self::test_input($apiOpt1);
        $sessionType = self::test_input($apiOpt2);
        $sqlQuery = "SELECT a.title, a.doiURL, a.abstract, s.description, s.chair, s.room, sl.day, sl.time, auth.author, auth.affiliation FROM activities a
         INNER JOIN 'sessions' s  ON a.sessionsID=s.id INNER JOIN 'slots' sl ON s.slotsID=sl.id INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id
         INNER JOIN authors auth ON pap_auth.authorID = auth.authorID
         WHERE (a.title LIKE :title OR a.abstract LIKE :abstract) AND s.type=:sessionType AND s.type!='break' AND s.type!='miscellaneous'";
        $params = [ ':title' => '%'.$searchType.'%', ':abstract' => '%'.$searchType.'%', ':sessionType' => $sessionType];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        echo $response;
    }
    /**
    * Prints the query for /api/presentations/category/:cat
    * @param $apiOpt2 is the session type used to filter the presentations.
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
    * Prints the query for /api/login
    * @param $loginApiUser is the email that is submitted.
    * @param $loginPassword is the password that is submitted.
    * sets three cookies, one containing jwt, other two used for frontEnd conditions.
    */
    public function loginRequest($loginApiUser, $loginPassword)
    {
        $email = $loginApiUser;
        $password = $loginPassword;

        $sqlQuery = "SELECT * FROM users WHERE email=:email";
        $params = [ ':email' => $email ];
        $response = new JSONRecordSet();
        $response = $response->getJSONRecordSet($sqlQuery, $params);
        $response = json_decode($response);
        $checkPasswordData = (array) $response->data->result[0];

        if (password_verify($password, $checkPasswordData['password'])) {
            $token = array();
            $token['iat'] = time();
            $token['iss'] = 'localhost';
            $token['exp'] = time() + (3600); //expires in an hour
            $token['email'] = $checkPasswordData['email'];
            $token['admin'] = $checkPasswordData['admin'];
            $secretKey = ApplicationRegistry::getSecretKey();
            $encodedToken = JWT::encode($token, $secretKey);//Change key to a random string.
            echo json_encode(array( "message" => "Successfully logged in"), JSON_PRETTY_PRINT);
            http_response_code(200);
            setcookie("authentication", $encodedToken, time() + (3600), "/", false);
            setcookie("loggedIn", true, time() + (3600), "/", false);
            if ($checkPasswordData['admin'] == 1) {
                setcookie("isAdmin", true, time() + (3600), "/", false);
            }
            //return $response;
        } else {
            echo("Password incorrect");
            http_response_code(401);
        }
    }
    /**
     * /api/logout
     * sets the cookies returned from a successful login to expire.
     */
    public function logout()
    {
        if (isset($_COOKIE["authentication"])) {
            unset($_COOKIE["authentication"]);
            setcookie("authentication", '', time() - 3600, '/');
        }
        if (isset($_COOKIE["loggedIn"])) {
            unset($_COOKIE["loggedIn"]);
            setcookie("loggedIn", '', time() - 3600, '/');
        }
        if (isset($_COOKIE["isAdmin"])) {
            unset($_COOKIE["isAdmin"]);
            setcookie("isAdmin", '', time() - 3600, '/');
        }
        echo json_encode(
            array(
                'data' => array(
                            "result"=>"LoggedOut"
                            )
                ),
            JSON_PRETTY_PRINT
        );
    }
    /**
     * Prints the query for /api/login/
     * @param $updateRequestBody contains the information to be updated.
     * @param $updateID contains the id of the session.
     */
    public function updateSessionChair($updateRequestBody, $updateID)
    {
        $data = self::test_input($updateRequestBody);
        $id = self::test_input($updateID);
        if (!isset($_COOKIE['authentication'])) {
            echo json_encode(array( "message" => "Cookie not set"), JSON_PRETTY_PRINT);
        } else {
            try {
                $decoded = JWT::decode($_COOKIE['authentication'], ApplicationRegistry::getSecretKey());
                if ($decoded->admin == 1) {
                    $sqlQuery = "UPDATE 'sessions' SET chair=:chair WHERE id IN (SELECT s.id FROM activities a INNER JOIN 'sessions' s ON a.sessionsID=s.id 
                    INNER JOIN 'slots' sl ON s.slotsID=sl.id  INNER JOIN 'papers_authors' pap_auth ON a.id=pap_auth.id WHERE pap_auth.id=:id)";
                    $params = [ ':chair' => $data, ':id' => $id ];
                    $response = new JSONRecordSet();
                    $response = $response->getJSONRecordSet($sqlQuery, $params);
                    echo json_encode(array( "message" => "Successfully changed session chair of id: '$id'"), JSON_PRETTY_PRINT);
                    ;
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
