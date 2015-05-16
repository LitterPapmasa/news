<?php

class NewsController
{
    
    public function indexAction()
    {

        $items = News::view();

        include __DIR__ . "/../views/news/news-view.php";
    }
    
    public function insertAction()
    {

        // Get our POST from form news-form.php
        if (! empty($_POST['header']) and ! empty($_POST['text'])) {
            $postData = [];
            $postData['header'] = Filter::input($_POST['header']);
            $postData['text'] = Filter::input($_POST['text']);
            $postData['date'] = date("Y-m-d H:i:s");
            
            $view = new View;
            $news = new News;
            if ($data = $news->insert($postData)) {
                $view->assign('message', 'Article "' . $postData['header'] . '" has been added.');
            } else {
                 $view->assign('message', 'Error. Article hasn\'t been add.');
            }
            
            $view->render("forms/news-form.php");

            $this->indexAction();
        } else {
            $view = new View;
            $view->assign('message','Error. Article hasn\'t been add.');
            $view->render("forms/news-form.php");
        }
    }
}

