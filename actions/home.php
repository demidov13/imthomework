<?php
require_once('./library/driver.php');
require_once('./library/view.php');
$articles = findAll();
$title = "Главная";

render('home', ['articles' => $articles]);

// ob_start();
// require_once './views/home.php';
// $content = ob_get_clean();