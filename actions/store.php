<?php
if(!empty($_POST)){
$toCart = [
    "title" => $_POST['title'],
    "price" => $_POST['price'],
];
$_SESSION['cart'][] = $toCart;

}

$page = './views/store.php';
$title = "Магазин";