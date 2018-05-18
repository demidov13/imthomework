<?php
require_once "classes/Sql.php";

class SqlProducts extends Sql
{
	public function update($newArr, $oldArr, $id)
	{
		$update = array_diff_assoc($newArr, $oldArr);
		foreach ($update as $name => $value) {
			if(!empty($value)){
				mysqli_query($this->mysqli, "UPDATE products SET $name = $value WHERE id = $id");
			}
		}
	}

	// public function update($id, $name, $articul, $brand, $description, $price, $publish, $image_path) {
	// 	mysqli_query($this->mysqli, "UPDATE products SET name = $name, articul = $articul, brand = $brand, description = $description, price = $price, publish = $publish, image_path = $image_path WHERE id = $id");
	// }

}