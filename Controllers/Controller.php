<?php
/**
 * This class is inherited by other controllers,
 * Each controller must be able to create a view for the
 * humanreable-pages as well as the api.
 */
class Controller
{
    public static function createView($viewName)
    {
        require_once("./Views/$viewName.php");
    }
}
