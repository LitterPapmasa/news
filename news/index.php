<?php

include __DIR__ . "/models/News.php";

$news = new News();
$data = $news->view();

include __DIR__ . "/views/news-view.php";