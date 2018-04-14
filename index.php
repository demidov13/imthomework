<?php
session_start();
require_once('./library/driver.php');
require_once('./library/view.php');
require_once "library/url/request.php";
// require_once "library/controller.php";

addRule('/', 'home', function($params){
$articles = findAll();
$title = "Главная";
render('home', ['articles' => $articles]);
});
addRule('/article', 'new', function($params){
  require_once('./actions/article.php');
});
addRule('/about', 'about', function($params){
  $title = "О нас";
  render('about');
});

start();
?>
<!DOCTYPE html>
<!-- saved from url=(0064)https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/ -->
<html lang="en">
<?php require_once "include/header.php" ?>
  <body>
    <header>
      <?php require_once "include/menu.php" ?>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
     <?=$content?>
    </main>
    <?php require_once "include/footer.php" ?>
</body>
</html>