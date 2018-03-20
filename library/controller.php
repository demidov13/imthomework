<?php
require_once('./library/driver.php');
$action = empty($_GET['action']) ? 'home' : $_GET['action'];
$page = null;
$title = "";
switch ($action) {
	case 'home':
    require_once('./actions/home.php');
		break;
	case 'about':
		$page = './views/about.php';
        $title = "О нас";
		break;
    case 'article':
    require_once('./actions/article.php');
        break;
    case 'store':
        $page = './views/store.php';
        $title = "Магазин";
        break;
    case 'cart':
        $page = './views/cart.php';
        $title = "Корзина";
        break;
	default:
		$page = './views/404.php';
		break;
}