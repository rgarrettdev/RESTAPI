<?php
require_once('./classes/config.php');
/**
 *
 * This uses the singleton pattern to return global style values. Other files have this pattern style
 * such as Route.php, Database.php
 * CONFIGLOCATION is specified in config.php
 *
 */ 
Class ApplicationRegistry extends Registry {
   
    private $values = array();
    private static $instance;

    private function __construct() {
        $this->openSystemConfigFile();
    }

    private static function instance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key) {
        return isset($this->values[$key]) ? $this->values[$key] : null;
    }

    protected function set($key, $value) {
        $this->values[$key] = $value;
    }

    private function openSystemConfigFile() {
        $filename = CONFIGLOCATION;  //CONFIGLOCATION a constant defined elsewhere
        if (file_exists($filename)) {
            $temp = simplexml_load_file($filename);
            foreach ($temp as $key => $value) {
                $this->set($key, trim($value));
            }
        }
    }
    
    public static function getDBName() {
        return self::instance()->get('dbname');
    }

    public static function getSecretKey() {
        return self::instance()->get('secretkey');
    }
}
?>
