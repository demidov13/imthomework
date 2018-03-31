<?php
//PCRE мнимые символы
/*
    \s - соответствует пробелу, знаку \r, \n, \t
    \S - наоборот. Любой не пробельный сивол
    \d - соответствует любой цифре от 0 - 9
    \D - это точно не цифра
    \w - это цифра от 0 - 9 или это буква
    \W - это точно не цифра и не буква
*/


//Экранирование
$str = "D:\ducuments\\file";
var_dump($str);

$result = preg_match("/\\\\file/", $str);
var_dump($result);

$str = "Hello\nworld";
echo $str;
$result = preg_match("/Hello\sworld/", $str);
var_dump($result);