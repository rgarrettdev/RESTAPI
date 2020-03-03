<?php 
//Test database connection

$db = new PDO( 'sqlite:./sqlite/chi2019.sqlite' );

$sqlQuery = "SELECT name FROM sqlite_master WHERE type='table'";

$stmt = $db->query( $sqlQuery );

while ( $myLine = $stmt->fetchObject()){
 
 echo $myLine->name." ";
}

?>