<?php
class Controller  {

    public static function createView($viewName) {
        require_once("./Views/$viewName.php");
    }
} 
?>