<?php
require_once "../../classes/Sql.php";

$sqlProducts = new Sql();
$sqlProducts->connect();
$arrProducts = $sqlProducts->read("products");
$arrCategories = $sqlProducts->read("categories");

$xml = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?> <products></products>");

foreach ($arrProducts as $products) {
    $xmlProduct = $xml->addChild('product');
    foreach($arrCategories as $category){
        if($products['category_id'] == $category['id']){
            $xmlProduct->addChild('category', $category['name']);
        }
    }
	foreach ($products as $row => $value) {
		$xmlProduct->addChild($row, $value);
	}
}

echo $xml->asXML();