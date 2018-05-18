<?php
require_once "classes/SqlProducts.php";

$sqlProducts = new SqlProducts();

$sqlProducts->connect();

if(isset($_POST['delete'])) {
	  $id = $_POST['id'];
    $sqlProducts->delete($id, "products");
}

if(isset($_POST['updateComplete'])){
  $newRow = $_POST;
  
  $id = $newRow['id'];
  $oldRow = $sqlProducts->get("products", $id);
  $sqlProducts->update($newRow, $oldRow, $id);

  // $arrUpdate = $_POST;
  // $id = (int) $arrUpdate['id'];
  // $articul = (int) $arrUpdate['articul'];
  // $price = (int) $arrUpdate['price'];
  // $publish = (int) $arrUpdate['publish'];
  // $sqlProducts->update($id, $newRow['name'], $articul, $newRow['brand'], $newRow['description'], $price, $publish, $newRow['image_path']);

} elseif(isset($_POST['updateCancel'])){
  $_POST = [];
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $updateProduct = $sqlProducts->get("products", $id);
    require_once "views/forms/updateProducts.php";

} else {
    $arrProducts = $sqlProducts->read("products");
    require_once "views/products.php";
}

