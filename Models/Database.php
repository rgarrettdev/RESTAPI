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
}

?>