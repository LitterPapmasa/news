<?php
define('INDEX_URL',$_SERVER["PHP_SELF"]);

function __autoload($class)
{
    if (file_exists(__DIR__.'/controllers/'.$class.'.php')){   
        require (__DIR__.'/controllers/'.$class.'.php');
    }
    if (file_exists(__DIR__.'/models/'.$class.'.php')){
        require (__DIR__.'/models/'.$class.'.php');
    }
    if (file_exists(__DIR__.'/classes/'.$class.'.php')){
        require (__DIR__.'/classes/'.$class.'.php');
    }
}

(isset($_GET['ctrl'])) ? $ctrl = $_GET['ctrl'] : $ctrl = 'News';
(isset($_GET['act'])) ? $act = $_GET['act'] : $act = 'index';

$controllerClassName = $ctrl.'Controller';
$controller = new $controllerClassName;
$action = $act.'Action';
$controller->$action();
