<?php
/**
 * This sets the api view to expect json to be returned from the endpoint.
 * Headers such as allow-methods and request method has allowed cookies to
 * be set correctly across other browsers such as firefox.
 */
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Request-Method: POST, GET, OPTIONS');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
