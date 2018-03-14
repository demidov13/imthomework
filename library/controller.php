<?php
$action = empty($_GET['action']) ? 'home' : $_GET['action'];
$page = null;

switch ($action) {
	case 'home':
		$page = './pages/home.php';
		break;
	case 'about':
		$page = './pages/about.php';
		break;
    case 'article':
        $page = './pages/article.php';
        break;
    case 'store':
        $page = './pages/store.php';
        break;
    case 'cart':
        $page = './pages/cart.php';
        break;
	default:
		$page = './pages/404.php';
		break;
}