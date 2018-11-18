<?php

define("BASE_PATH", dirname(dirname(__FILE__)));

require_once(BASE_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require_once(BASE_PATH . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'functions.php');


spl_autoload_register(function($class_name) {
    $class_name = base_path($class_name) . ".php";

    if(file_exists($class_name)) {
        require_once($class_name);
    }else {
        echo "Class  " . $class_name . " Not Found ";
        exit;
    }

});

try{
    get_router();   
}catch(TypeError $e) {
    echo $e->getMessage();
}


