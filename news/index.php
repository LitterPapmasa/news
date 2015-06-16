<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$folderPath = explode('/',$_SERVER['PHP_SELF']);
array_pop($folderPath);

define('INDEX_URL',implode('/', $folderPath));

$currentPath = explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH ));
$relPathArray = array_diff_assoc($currentPath, $folderPath);
$ctrl = current($relPathArray);
$act = next($relPathArray);


(!empty($ctrl)) ? $ctrl = ucfirst(strtolower($ctrl)) : $ctrl = 'News';
(!empty($act)) ? $act = ucfirst(strtolower($act)) : $act = 'index';


$controllerClassName = $ctrl.'Controller';
try {

    require_once __DIR__.'/autoload.php';
    Auth::start();

	$controller = new $controllerClassName;
	$action = $act.'Action';
	$controller->$action();

} catch (Exception $e) {
    var_dump("!");
    $error = new ErrorController($e);

}