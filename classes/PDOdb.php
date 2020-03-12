<?php
/**
 * PDO connection class
 */
class pdoDB
{
    private static $dbconnect = null;
    private function __construct() {

    }
    private function __clone(){

    }
    /**
     * Return Connection or Create connection
     * @return object (PDO)
     * @access public
     */
    public static function getConnection()
    {
        $dbpath = ApplicationRegistry::getDBName();
        if (!self::$dbconnect) {
            try {
                self::$dbconnect = new PDO("sqlite:./sqlite/chi2019.sqlite");
                // set the PDO error mode to exception
                self::$dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $error_con)
                {
                echo "Connection failed: " . $error_con->getMessage();
                }
            }
            return self::$dbconnect;
        }
    }
?>