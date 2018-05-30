<?php
require_once "../classes/Sql.php";

$sqlProducts = new Sql();
$sqlProducts->connect();
$arrProducts = $sqlProducts->read("products");

if($_GET['option'] == 'xml'){

	$xml = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?> <products></products>");

	foreach ($arrProducts as $products) {
		$xmlProduct = $xml->addChild('product');
		foreach ($products as $row => $value) {
			$xmlProduct->addChild($row, $value);
		}
	}

	$fileXML = fopen('../views/export/products.xml', 'w+');
	fclose($fileXML);

	$xml->asXML("../views/export/products.xml");

	header("Location: ../views/export/products.xml");

}elseif($_GET['option'] == 'json'){

	$json = json_encode($arrProducts);
	$fileJSON = fopen('../views/export/products.json', 'w+');
	fwrite($fileJSON, $json);
	fclose($fileJSON);

	header("Location: ../views/export/products.json");

}