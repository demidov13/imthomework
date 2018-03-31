<?php
//PCRE управляющие конструкции
/*
    . - любой символ кроме перевода строки \n
    * - 0 или более вхождений
    + - 1 или более вхождений
    ? - 0 или одно вхождение (более одного уже не подходит)
    | - начало условного выбора
    ^ - начало строки (в символьном классе означает отрицание)
    $ - конец строки (.jpg$)
    \ - экринирующий символ
    [] - символьный класс
    () - подмаска (результат попадает в карман)
    {} - количество {x,}/{x}/{x,y}
    
    POSIX
    [:digit:] — цифра
    [:alnum:] — буква или цифра
    [:space:] — пробельный символ
    [:blank:] — пробельный символ или символы с кодом 0 и 255
    [:cnrtl:] — управляющий символ
    [:graph:] — символ псевдографики
    [:lower:] — символ нижнего регистра
    [:upper:] — символ верхнего регистра
    [:print:] — печатаемый символ
    [:punct:] — знак пунктуации
    [:xdigit:] — цифра или буква от A до F.
*/


$str = 'Hello world!';

$result = preg_match('/orld/', $str);
var_dump($result);

$result = preg_match('/orld$/', $str);
var_dump($result);

$result = preg_match('/orld!$/', $str);
var_dump($result);


$result = preg_match('/or[lz]d/', "Hello world");
var_dump($result);

$result = preg_match('/or[lz]d/', "Hello worzd");
var_dump($result);


$result = preg_match('/a|b|c/', "abcdefg");
var_dump($result);

$result = preg_match('/[abc]/', "abcdefg");
var_dump($result);



//Карманы
$date = "06111986";

$result = preg_match('/(\d{2}).*(\d{2}).*(\d{4})/', $date, $mathes);
var_dump($result);

var_dump($mathes);

//Использование карманов прямо в шаблоне
$html = "<b>Home</b>";
$result = preg_match('#<(\w+) [^>]* > (.*?) </\1>#xs', $html, $m);
var_dump($result);
var_dump($m);


//Именованные карманы (?<name>)
$result = preg_match('/(?<day>\d{2}).*(?<month>\d{2}).*(?<year>\d{4})/', $date, $mathes);
var_dump($result);

var_dump($mathes);

//Игнорирование карманов (?:)
$result = preg_match('/(?<day>\d{2}).*(?<month>\d{2}).*(?:\d{4})/', $date, $mathes);
var_dump($result);

var_dump($mathes);