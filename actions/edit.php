<?php
require_once('./library/driver.php');
$article = find($_GET['id']);
$editId = $article['id'];
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
        $article['title'] = $_POST['title'];
        $article['content'] = $_POST['content'];
        $article['id'] = $editId;
        var_dump($editId);
        var_dump($article); exit;

        if(save($article)){
            header("Location: http://web/");
        }
    }

}
    $page = './views/article.php';
    $title = "Редактирование статьи";