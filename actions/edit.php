<?php
require_once('./library/driver.php');
$article = find($_GET['id']);
$errors = [];
if(!empty($_POST)) {
    if (empty($_POST['title'])) {
        $errors['title'] = "Поле не должно быть пустым";
    }
    if (empty($_POST['content'])) {
        $errors['content'] = "Поле не должно быть пустым";
    }
    if (strlen($_POST['title']) > 255) {
        $errors['title'] = "Тема не может иметь длину больше 255 символов";
    }
    if(empty($errors)) {
        $article = $_POST;

        if(save($article)){
            header("Location: https://demidov-dz.herokuapp.com/");
        }
    }

}
    $page = './views/article.php';
    $title = "Редактирование статьи";