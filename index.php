<?php
//  // Вложенные шаблоны
// ob_start();
// require_once './include/test.php';
// $html = ob_get_clean();
// echo $html;


// exit;

session_start();
require_once "library/controller.php";
require_once "library/url/request.php";

addRule('/blog/{id:d}', function($params){

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