<?php

if (file_exists(__DIR__.'/core/LogController.php')){
	require_once (__DIR__.'/core/LogController.php');
} else {
	throw new Exception('1');
}

if (file_exists(__DIR__.'/core/ErrorController.php')){
     require_once (__DIR__.'/core/ErrorController.php');
} else {
	throw new Exception('2');
}


function __autoload($class)
{
	    if (file_exists(__DIR__.'/controllers/'.$class.'.php')){
	        require_once (__DIR__.'/controllers/'.$class.'.php');
	    }
	    elseif (file_exists(__DIR__.'/models/'.$class.'.php')){
	        require_once (__DIR__.'/models/'.$class.'.php');
	    }
	    elseif (file_exists(__DIR__.'/classes/'.$class.'.php')){
	        require_once (__DIR__.'/classes/'.$class.'.php');
	    } else {
	    	throw new Exception('404');
	    }

}