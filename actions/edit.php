<?php
require_once('./library/driver.php');
require_once('./library/fs.php');
$article = find($_GET['id']);
$errors = [];
if(!empty($_POST)) {
    if(empty($_POST['title'])) {
        $errors['title'] = "Поле не должно быть пустым";
    }
    if(empty($_POST['content'])) {
        $errors['content'] = "Поле не должно быть пустым";
    }
    if(strlen($_POST['title']) > 255) {
        $errors['title'] = "Тема не может иметь длину больше 255 символов";
    }
    if($_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/png") {
        if(empty($errors && $_GET['action'] == "edit")) {
            $article = $_POST;
            $article['image'] = upload($article['id']);
            if (save($article)) {
                header("Location: /index.php?action=home");
            }
        }
    }else{
        $errors['image'] = "Выберите, пожалуйста, файл в формате .jpg/.png";
    }
}
    $page = './views/article.php';
    $title = "Редактирование статьи";