<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Каталог товаров</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>     
<body>
<div class="row" style="margin: 10px">
<div class="filter col"  style="width: 300px; float: left; padding: 10px; border: 1px solid #e3f2fd;">

	<form name="search" method="post" action="/">
		<div class="input-group mb-3">
  			<input type="text" name="search" class="form-control" placeholder="Поиск..." aria-label="Имя получателя" aria-describedby="basic-addon2">
  			<div class="input-group-append">
    			<button class="btn btn-outline-secondary" type="submit">Найти</button>
  			</div>
		</div>
	</form>

	<form name="filters" method="post" action="/">
		<select class="custom-select" name="sort">
  			<option selected>Сортировать по:</option>
  			<option>Цене</option>
  			<option>Дате добавления</option>
  			<option>Имени</option>
		</select>
		</br>
		</br>
		<p>Цена:</p>
		<div class="form-row">
			</br>
    		<div class="col">
      			<input type="number" name="price1" class="form-control" placeholder="От">
    		</div>
    		<div class="col">
      			<input type="number" name="price2" class="form-control" placeholder="До">
    		</div>
  		</div>
  		</br>
  		<p>Бренд:</p>
		<div class="form-check">
  			<input type="checkbox" name="brand" value="Ювентус" class="form-check-input" id="juventus">
  			<label class="form-check-label" for="juventus">Ювентус</label>
  			</br>
  			<input type="checkbox" name="brand" value="Милан" class="form-check-input" id="milan">
  			<label class="form-check-label" for="milan">Милан</label>
  			</br>
  			<input type="checkbox" name="brand" value="Барселона" class="form-check-input" id="barselona">
  			<label class="form-check-label" for="barselona">Барселона</label>
		</div>
		</br>
		<button type="submit" class="btn btn-primary">Фильтровать</button>
	</form>
</div>

<?php

/**
 * @param $page - генерация переменной для оператора LIMIT
 */

$page = '0, 5';

if(!empty($_GET)){
	switch ($_GET['page']) {
	case 1:
		$page = '0, 5';
		break;
	case 2:
		$page = '5, 5';
		break;
	case 3:
		$page = '10, 5';
		break;	
	default:
		$page = '0, 5';
		break;
	}
}

/**
 * @param $connect - соединение с базой данных
 */

$connect = mysqli_connect("127.0.0.1", "root", "", "bd");
		if(mysqli_connect_errno($connect)){
    		echo "Не удалось подключиться к MySQL:" . mysqli_connect_error();
		}

/**
 * @param $search - передача параметров поиска через POST, подготовка запроса к базе при поиске товаров по названию или бренду.
 */

if(isset($_POST['search'])){
	$search = $_POST['search'];
	$search = "%".$search."%";
	$query = "SELECT name, price, image_path FROM products WHERE name LIKE ? OR brand LIKE ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "ss", $search, $search);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$resSearch[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}
		$arrProducts = $resSearch;
}

/**
 * @param $brand, $order, $price1, $price2 - присваиваем значения переменным, если фильтры были переданы POST-ом.
 */

if(isset($_POST['brand'])){
	$brand = $_POST['brand'];
}

if(isset($_POST['sort'])) {
	switch ($_POST['sort']) {
		case 'Цене':
			$order = "price";
			break;
		case 'Имени':
			$order = "name";
			break;
		case 'Дате добавления':
			$order = "created_at";
			break;	
		default:
			$order = "created_at";
			break;
	}
}

if(isset($_POST['price1']) || isset($_POST['price2'])){
	if(empty($_POST['price1'])){
		$price1 = 0;
	}else{
		$price1 = $_POST['price1'];
	}
	if(empty($_POST['price2'])){
		$price2 = 999999;
	}else{
		$price2 = $_POST['price2'];
	}	
}	

/**
 * @param $arrProducts - в этой переменной хранится фиинальный массив с товарами. Проверяем, сколько фильтров было передано через POST и подготавливаем запрос к базе данных для каждого варианта.
 */

if(isset($_POST['sort']) && isset($_POST['price']) && isset($_POST['brand'])){

	$query = "SELECT name, price, image_path FROM products WHERE (brand = ?) AND (price BETWEEN ? AND ?) ORDER BY ? LIMIT ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "siiss", $brand, $price1, $price2, $order, $page);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['sort']) && isset($_POST['brand'])){

	$query = "SELECT name, price, image_path FROM products WHERE brand = ? ORDER BY ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "ss", $brand, $order);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['sort']) && isset($_POST['price'])){

	$query = "SELECT name, price, image_path FROM products WHERE price BETWEEN ? AND ? ORDER BY ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "iis", $price1, $price2, $order);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['price']) && isset($_POST['brand'])){
	
	$query = "SELECT name, price, image_path FROM products WHERE (brand = ?) AND (price BETWEEN ? AND ?)";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "sii", $brand, $price1, $price2);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['brand'])){

	$query = "SELECT name, price, image_path FROM products WHERE brand = ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "s", $brand);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['price'])){
	$query = "SELECT name, price, image_path FROM products WHERE price BETWEEN ? AND ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "ii", $price1, $price2);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}

}elseif(isset($_POST['sort'])){

	$query = "SELECT name, price, image_path FROM products ORDER BY ?";
		if ($stmt = mysqli_prepare($connect, $query)) {
    		mysqli_stmt_bind_param($stmt, "s", $order);
    		mysqli_stmt_execute($stmt);
    		mysqli_stmt_bind_result($stmt, $name, $price, $image_path);

 			while(mysqli_stmt_fetch($stmt)){
 				$arr['name'] = $name;
 				$arr['price'] = $price;
 				$arr['image_path'] = $image_path;
 				$arrProducts[] = $arr;
 			}
    	mysqli_stmt_close($stmt);
		}
}

// Вывод товаров без каких-либо фильтров (начальная страница)
if(empty($_POST)){
	$res = mysqli_query($connect, "SELECT name, price, image_path FROM products LIMIT $page");
	$arrProducts = mysqli_fetch_all($res, MYSQLI_ASSOC);
}

// Скрипт закрывается, дальше идет html с таблицой товаров и пагинацией
?>

<div class="col-8">
<table class="table table-bordered table-hover">
  <thead>
    <tr style="background-color: #e3f2fd">
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Картинка</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($arrProducts as $product): ?>
    <tr class="table-light">
      <td><?=$product['name']?></td>
      <td><?=$product['price']?></td>
      <td><img src="<?=$product['image_path']?>" width="200" height="200" alt="image_path"></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
  		<li class="page-item <?php echo ($_GET['page'] == 1) ? 'active' : '' ?>">
  			<a class="page-link" href="/?page=<?=1?>">1</a>
  		</li>
  		<li class="page-item <?php echo ($_GET['page'] == 2) ? 'active' : '' ?>">
  			<a class="page-link" href="/?page=<?=2?>">2</a>
  		</li>
  		<li class="page-item <?php echo ($_GET['page'] == 3) ? 'active' : '' ?>">
  			<a class="page-link" href="/?page=<?=3?>">3</a>
  		</li>
  </ul>
</nav>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>