<?php
require_once('./library/driver.php');
$errors = [];
if(!empty($_POST)){
    if(empty($_POST['title'])){
        $errors['title'] = "Поле не должно быть пустым";
    }
    if(empty($_POST['content'])){
        $errors['content'] = "Поле не должно быть пустым";
    }
    if(strlen($_POST['title']) > 255){
        $errors['title'] = "Тема не может иметь длину больше 255 символов";
    }
    if(empty($errors) && $_GET['action'] == "article") {
        $article = $_POST;
        $article['id'] = uniqid();
        if(save($article)){
            header("https://demidov-dz.herokuapp.com/index.php?action=home");
        }
    }
}

        $page = './views/article.php';
        $title = "Добавление статьи";