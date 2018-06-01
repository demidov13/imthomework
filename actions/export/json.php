<?php
require_once "../../classes/Sql.php";

$sqlProducts = new Sql();
$sqlProducts->connect();
$arrProducts = $sqlProducts->read("products");
$arrCategories = $sqlProducts->read("categories");

foreach($arrProducts as $key => $product){
    foreach ($arrCategories as $category) {
        if($product['category_id'] == $category['id']){
            $arrProducts[$key]['category'] = $category['name'];
        }
    }
}
$json = json_encode($arrProducts);
echo $json;