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

            $news = new News();
            if ($data = $news->insert($postData)) {
                $message = 'Article "' . $postData['header'] . '" has been added.';
            } else {
                $message = 'Error. Article hasn\'t been add.';
            }

            include __DIR__ . "/../views/forms/news-form.php";
        } else {
            include __DIR__ . "/../views/forms/news-form.php";
        }
    }
}

