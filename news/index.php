<?php
define('INDEX_URL',$_SERVER["PHP_SELF"]);

require_once __DIR__.'/autoload.php';

(isset($_GET['ctrl'])) ? $ctrl = $_GET['ctrl'] : $ctrl = 'News';
(isset($_GET['act'])) ? $act = $_GET['act'] : $act = 'index';

$controllerClassName = $ctrl.'Controller';
$controller = new $controllerClassName;
$action = $act.'Action';
$controller->$action();
