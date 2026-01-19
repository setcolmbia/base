<?php
session_start();
//ini_set('display_errors', 1);
require_once "config.php";

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
$method = isset($_GET['method']) ? $_GET['method'] : 'index';

spl_autoload_register(function($class){
    if(file_exists("controllers/{$class}.php")){
        require_once "controllers/{$class}.php";
    }else if(file_exists("models/{$class}.php")){
        require_once "models/{$class}.php";
    }else if(file_exists("vendors/asterisk/phpagi-asmanager.php")){
        require_once "vendors/asterisk/phpagi-asmanager.php";
    }else{
        require_once "views/errors/404.html";
    }
});

$controller = "{$controller}Controller";
call_user_func([new $controller(), $method]);
