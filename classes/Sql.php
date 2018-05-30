<?php

class Sql
{
	public $mysqli;

	public function connect()
	{
		$mysqli = mysqli_connect("127.0.0.1", "root", "", "bd");
		if(mysqli_connect_errno($mysqli)){
    		echo "Не удалось подключиться к MySQL:" . mysqli_connect_error();
		}
		$this->mysqli = $mysqli;
		return $this->mysqli;
	}

	public function read($table)
	{
		$res = mysqli_query($this->mysqli, "SELECT * FROM $table");
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $result;
	}

	public function get($table, $id)
	{
		$res = mysqli_query($this->mysqli, "SELECT * FROM $table WHERE id=$id");
		$arr = mysqli_fetch_all($res, MYSQLI_ASSOC);
		$result = $arr[0];
		return $result;
	}

	public function delete($id, $table)
	{
		mysqli_query($this->mysqli, "DELETE FROM $table WHERE id=$id");
	}

	public function update($newArr, $oldArr, $id)
	{
		$update = array_diff_assoc($newArr, $oldArr);
		foreach ($update as $name => $value) {
			if(!empty($value)){
				mysqli_query($this->mysqli, "UPDATE products SET $name = '$value' WHERE id = $id");
			}
		}
	}
}