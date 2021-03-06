<?php

namespace Core;

Class Router {
    
    use SingletonTrait;
    
    private function __construct() {
        $uri = $_SERVER["REQUEST_URI"];
        $parts = array_values(array_filter(explode("/", $uri)));
        $controllersName = !empty($parts[0]) ? ucfirst($parts[0]) : "Home";
        $controllerClassName = "\\app\\Controllers\\{$controllersName}Controller";
        $object = new $controllerClassName();
        $action = count($parts) > 1 ? kebabToCamel($parts[1]) : "index";
        $result = $object->$action();
        if(is_a($result, "Core\\View")) {
            echo $result;
        }
        exit;
    }
}