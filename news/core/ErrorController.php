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

    	$codeError = $e->getMessage();
        switch ($codeError) {
            case '404' : Log::write('Page not found!');
            			 $this->error404Action();
            			 exit;
            	break;
            default : Log::write('Error undefined');
                break;
        }

		$view = new View();
		$view->codeError = $codeError;
		$view->render('error/error.php');
    }
}