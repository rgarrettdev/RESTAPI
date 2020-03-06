<?php 
/**
 *Front Controller deals with all the routing.
 */
require_once('./classes/FrontController.php');
/**
 * Autoloader loads arbitrary php files.
 */
function __autoload($class_name) {
    if (is_readable('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } else if (is_readable('./Controllers/'.$class_name.'.php')) {
        require_once './Controllers/'.$class_name.'.php';
    } else if (is_readable('./Models/'.$class_name.'.php')) {
        require_once './Models/'.$class_name.'.php';
    }
}
?>