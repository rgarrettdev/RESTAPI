<?php
/**
* abstract class that creates a database connection and returns a recordset
* Follows the recordset pattern
*
* @author Ryan Garrett
*
*/
abstract class RecordSet
{
    protected $conn;
    protected $queryResult;
    public function __construct()
    {
        $this->conn = pdoDB::getConnection();
    }
    /**
    * This function will execute the query as a prepared statement if there is a params array
    * If not, it executes as a regular statament.
    *
    * @param string $sql The sql for the recordset
    * @param array $params An optional associative array if you want a prepared statement
    * @return PDO_STATEMENT
    */
    public function getRecordSet($sql, $params = array())
    {
        if (!empty($params)) {
            $this->queryResult = $this->conn->prepare($sql);
            $this->queryResult->execute($params);
        } else {
            $this->queryResult = $this->conn->query($sql);
        }
        return $this->queryResult;
    }
}
