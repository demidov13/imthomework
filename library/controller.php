<?php
$action = empty($_GET['action']) ? 'home' : $_GET['action'];
$page = null;
$title = "";

switch ($action) {
	case 'home':
		$page = './pages/home.php';
		$title = "Главная";
		break;
	case 'about':
		$page = './pages/about.php';
        $title = "О нас";
		break;
    case 'article':
        $page = './pages/article.php';
        $title = "Добавление статьи";
        break;
    case 'store':
        $page = './pages/store.php';
        $title = "Магазин";
        break;
    case 'cart':
        $page = './pages/cart.php';
        $title = "Корзина";
        break;
	default:
		$page = './pages/404.php';
		break;
}