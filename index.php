
<?php
// * Выучить константы php
// is_dir
// mkdir
// file_get_contents
// file_put_contents
// scandir
// __DIR__
// dirname
// fopen, fclose, fgets, fwrite

require_once("store.php");
$user1 = [
  'name' => 'Vit',
  'email' => 'vit@gmail.com'
];
$user2 = [
  'name' => 'Anita',
  'email' => 'Anita@gmail.com'
];
$users[] = $user1;
$users[] = $user2;
if(save($users)){
  echo "Сохранилось";
} else {
  echo "Не сохранилось";
}


exit;
?>

<?php require_once "library/controller.php" ?>
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