<?php
require_once "../classes/Sql.php";

$sqlProducts = new Sql();
$sqlProducts->connect();
$arrProducts = $sqlProducts->read("products");
$arrCategories = $sqlProducts->read("categories");

if($_GET['option'] == 'xml'){

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

	$fileXML = fopen('../views/export/products.xml', 'w+');
	fclose($fileXML);

	$xml->asXML("../views/export/products.xml");

	header("Location: ../views/export/products.xml");

}elseif($_GET['option'] == 'json'){

	foreach($arrProducts as $key => $product){
		foreach ($arrCategories as $category) {
			if($product['category_id'] == $category['id']){
				$arrProducts[$key]['category'] = $category['name'];
			}
		}
	}

	$json = json_encode($arrProducts);
	$fileJSON = fopen('../views/export/products.json', 'w+');
	fwrite($fileJSON, $json);
	fclose($fileJSON);

	header("Location: ../views/export/products.json");

}