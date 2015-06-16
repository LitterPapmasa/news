<?php

class ErrorController
{
    public function indexAction()
    {
        $view = new View;
        $view->render('error/error404.php');
    }

    public function error404Action()
    {
        $view = new View;
        $view->render('error/error404.php');
    }

    public function __construct(Exception $e)
    {
    	$log = new LogController();
    	$codeError = $e->getMessage();
        switch ($codeError) {        	
            case '404' : $errorMessage = 'Page not found!';
            			 $log->addError($errorMessage);  
            			 $this->error404Action() ;
            			 exit;            			 
            	break;
            case '1' : $errorMessage = 'LogController.php file doesn\'t exist';
            	       $log->addError($errorMessage); 
           		break;
            default : $errorMessage = 'Error undefined';
            		  $log->addError($errorMessage);            
            break;
        }

		$view = new View();
		$view->codeError = $codeError;
		$view->render('error/error.php');
    }
}