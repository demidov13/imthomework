<?php
session_start(); 
require_once "library/controller.php" 
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
     <?php require_once $page; ?>
    </main>

    <?php require_once "include/footer.php" ?>

</body>
</html>