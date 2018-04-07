<?php

// MKash - приложение для хранения сессий. Используется для скорости, когда веб-приложение расположено на нескольких серверах

// Служебная часть кода
/* $sid = uniqid();
if(isset($_COOKIE['mysid'])){
    $sid = $_COOKIE['mysid'];
}
setcookie('mysid', $sid);
if(file_exists(sprintf("%s.sess", $sid))){
    $_sess = unserialize(file_get_contents(sprintf("%s.sess", $sid)));
}else{
    $_sess = [];
}
$_sess['count'] += 1;
echo $_sess['count'];

// Наш код

//Служебная часть кода

file_put_contents(sprintf("%s.sess", $sid), serialize($_sess));
*/

// session_name('test'); - Имя сессии меняется для группировки сессий (почти не используется)
// Лучше группировать сессии встроенными массивами внутри сессии

session_start();
session_id(); // Создает айди сессии
echo session_id(); // Получает и выводит айди сессии
$_SESSION['count'] += 1;
echo $_SESSION['count'];

exit;