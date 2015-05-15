<?php

include __DIR__ . "/models/News.php";

$items = News::view();

include __DIR__ . "/views/news-view.php";