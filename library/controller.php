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
	default:
		$page = './pages/404.php';
		break;
}