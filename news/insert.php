<?php

include __DIR__ . "/models/News.php";
include __DIR__ . "/functions/filter.fun.php";

// Get our POST from form news-form.php
if (!empty($_POST['header']) and !empty($_POST['text'])){
    $postData = [];
    $postData['header'] = inputFilter($_POST['header']);
    $postData['text'] = inputFilter($_POST['text']);
    $postData['date'] = date("Y-m-d H:i:s");

    $news = new News();
    if ($data = $news->insert($postData)){
        $message = 'Article "' . $postData['header'] . '" has been added.';
    } else {
        $message = 'Error. Article hasn\'t been add.';
    }

    include __DIR__ . "/forms/news-form.php";
} else {
    include __DIR__ . "/forms/news-form.php";
}