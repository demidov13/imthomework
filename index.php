<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Панель управления</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>     
<body>
  <header>
<ul class="nav nav-tabs nav-justified">
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'products') ? 'active' : '' ?>" href="?actions=products">Товары</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'orders') ? 'active' : '' ?>" href="index.php?actions=orders">Заказы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'orders_to_products') ? 'active' : '' ?>" href="index.php?actions=orders_to_products">Связь товары/заказы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'categories') ? 'active' : '' ?>" href="index.php?actions=categories">Категории</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'users') ? 'active' : '' ?>" href="index.php?actions=users">Пользователи</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['actions'] == 'articles') ? 'active' : '' ?>" href="index.php?actions=articles">Статьи</a>
  </li>
   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle <?php echo ($_GET['actions'] == 'xml' || $_GET['actions'] == 'json') ? 'active' : '' ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Экспорт</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/actions/export.php?option=xml" target="_blank">файл XML</a>
      <a class="dropdown-item" href="/actions/export.php?option=json" target="_blank">файл JSON</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="/actions/export/xml.php" target="_blank">echo XML</a>
      <a class="dropdown-item" href="/actions/export/json.php" target="_blank">echo JSON</a>
    </div>
  </li>
</ul>
  </header>   
  <main>
    <?php
      if(empty($_GET['actions'])){
          echo "</br><h3 style='margin-left:30px'>Добро пожаловать в панель управления.</br>Для начала работы выберите таблицу в верхнем меню.</h3>";
      }else{
        $actions = "actions/".$_GET['actions'].".php";
        require_once $actions;
      }
    ?>
     
  </main>


 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>