<?php
//PCRE простые символы
//@link http://php.net/manual/ru/reference.pcre.pattern.syntax.php
//@link http://www.exlab.net/tools/sheets/regexp.html
/*
    Модификаторы шаблонов
    i - регистронезависимый поиск
    x - разрешить комментарии и пробелы в шаблоне
    m - многострочный текст
    s - точка соответствует всем символам включая пробел. Без него все кроме пробела
 */
$string = "abcdefgh";

$result = preg_match('/def/', $string);
var_dump($result);

$matches = [];
preg_match('/def/', $string, $matches);
var_dump($matches);

//Экранирование
$path = 'app/data/images';
// $result = preg_match('/app\/data\/images/', $path);
$result = preg_match('/app\/data\/images/', $path);
var_dump($result);

//Альтернативные ограничители #, ~
$path = 'app/data/images';
// $result = preg_match('/app\/data\/images/', $path);
$result = preg_match('#app/data/images#', $path);
var_dump($result);




//Замена
echo preg_replace('/hello/', 'HELLO', "hello world");


