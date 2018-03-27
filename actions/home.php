<?php
require_once('./library/driver.php');
$articles = findAll();

$page = './views/home.php';
$title = "Главная";