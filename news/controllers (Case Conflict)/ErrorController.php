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
        switch ($e->getMessage()) {
            case '404' : $this->error404Action() ; break;
            case '1' : $errorMessage = 'Страница не найдена'; break;
            default : $errorMessage = 'Не опознанная ошибка'; break;
        }


    }
}