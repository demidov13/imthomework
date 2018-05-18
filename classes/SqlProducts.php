<?php
require_once "classes/Sql.php";

class SqlProducts extends Sql
{
	public function update($newArr, $oldArr, $id)
	{
		$update = array_diff_assoc($newArr, $oldArr);
		return $update;
		foreach ($update as $name => $value) {
			if(!empty($value)){
				mysqli_query($this->mysqli, "UPDATE products SET $name = $value WHERE id = $id");
			}
		}
	}

}