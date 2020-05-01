<?php
class Database
{
    public static function query($query, $params = array())
    {
        $stmt = pdoDB::getConnection()->prepare($query);
        $stmt->execute($params);
        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = json_encode($data, JSON_PRETTY_PRINT);
            return $response;
        }
    }

    public static function loginRequest($query, $params = array())
    {
        $stmt = pdoDB::getConnection()->prepare($query);
        $stmt->execute($params);
        if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //Checks if password is valid
        }
    }
}
