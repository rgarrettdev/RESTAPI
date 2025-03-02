<?php
/**
*
* Return a JSON recordset
*
* @author Ryan Garrett
*/
class JSONRecordSet extends RecordSet
{
    /**
    * function to return a record set as a json encoded string
    * @param $sql string with sql to execute to retrieve the record set
    * @param $params associate array of params for preparted statement
    * @return string a json object in our standard format
    */
    public function getJSONRecordSet($sql, $params = array())
    {
        $queryResult = $this->getRecordSet($sql, $params);
        $recordSet = $queryResult->fetchAll(PDO::FETCH_ASSOC);
        $nRecords = count($recordSet);
        if ($nRecords == 0) {
            $status = 200;
            $message = array("text" => "No records found");
            $result = [];
        } else {
            $status = 200;
            $message = array("text" => "Records found");
            $result = $recordSet;
        }
        return json_encode(
            array(
 'status' => $status,
 'message' => $message,
 'data' => array(
 "rowCount"=>$nRecords,
"result"=>$result
 )
 ),
            JSON_PRETTY_PRINT
        );
    }
}
