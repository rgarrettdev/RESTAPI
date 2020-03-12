<?php
class Database 
{
    public static function query($query, $params = array()) {
        $stmt = pdoDB::getConnection()->prepare($query);
        $stmt->execute($params);
        if (explode(' ',$query)[0] == 'SELECT') {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = json_encode($data, JSON_PRETTY_PRINT);
            return $response;
        }
    }

    public static function loginRequest($query, $params = array()) {
        $stmt = pdoDB::getConnection()->prepare($query);
        $stmt->execute($params);
        if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //Checks if password is valid
            if (password_verify($_POST['password'], $data['password'])) {
                $token = array();
                $token['iat'] = time();
                $token['iss'] = 'localhost';
                $token['exp'] = time() + (3600); //expires in an hour
                $token['email'] = $data['email'];
                $token['admin'] = $data['admin'];
                $secretKey = ApplicationRegistry::getSecretKey();
                $encodedToken = JWT::encode($token, $secretKey);//Change key to a random string.
                $response = json_encode(array("message" => "Success", "token" => $encodedToken),JSON_PRETTY_PRINT);
                setcookie("user", $encodedToken, time() + (3600), "/");
                return $response;
            }
        } else {
            echo("User does not exist");
        }   
        //TODO:: FINISH LOGIN CHECKS password_verify()
    }
}

?>