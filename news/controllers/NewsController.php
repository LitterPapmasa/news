<?php

class NewsController
{
    
    public function indexAction()
    {

        $items = News::view();
        $view = new View;
        $view->items = $items;
        $view->render("news/news-view.php");
    }
    
    public function insertAction()
    {

        // Get our POST from form news-form.php
        if (!empty($_POST['header']) and !empty($_POST['text'])) {
            $postData = [];
            $postData['header'] = Filter::input($_POST['header']);
            $postData['text'] = Filter::input($_POST['text']);
            $postData['date'] = date("Y-m-d H:i:s");

            $view = new View;
            $news = new News;
            if ($data = $news->insert($postData)) {
                $view->message = 'Article "' . $postData['header'] . '" has been added.';
            } else {
                $view->message = 'Error. Article hasn\'t been add.';
            }

            $view->render("forms/news-form.php");

            $this->indexAction();
        } else {
            $view = new View;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $view->message = 'Error. Article hasn\'t been add.';
            }

            $view->render("forms/news-form.php");
        }

    }
}

