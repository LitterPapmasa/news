<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Kiev');

$folderPath = explode('/',$_SERVER['PHP_SELF']);
array_pop($folderPath);

define('INDEX_URL',implode('/', $folderPath));

$currentPath = explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH ));
$relPathArray = array_diff_assoc($currentPath, $folderPath);
$ctrl = current($relPathArray);
$act = next($relPathArray);


(!empty($ctrl)) ? $ctrl = ucfirst(strtolower($ctrl)) : $ctrl = 'News';
(!empty($act)) ? $act = ucfirst(strtolower($act)) : $act = 'index';

require_once (__DIR__.'/core/Log.php');
require_once (__DIR__.'/core/ErrorController.php');

$controllerClassName = $ctrl.'Controller';
try {

    require_once __DIR__.'/autoload.php';
    Auth::start();

	$controller = new $controllerClassName;
	$action = $act.'Action';
	// if action wrong
	if (method_exists($controller, $action) === false) {
	    throw new Exception('404');
	}
	$controller->$action();

} catch (Exception $e) {
    $error = new ErrorController($e);
}