<?php

if(isset($_POST['delete'])) {
    $_SESSION['cart'] = [];
}

$page = './views/cart.php';
$title = "Корзина";

