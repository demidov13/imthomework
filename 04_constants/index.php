<?php
/**
 * Все константы определяются в большом регистре.
 */
define("MY_CONST", 1);

var_dump(MY_CONST); //int 1


//Только для версии PHP 7.0 и выше, в качестве занчений констант можно
//использовать массивы
if(PHP_MAJOR_VERSION >= 7){
    define("STRUCTURE", [
        1,2,3
    ]);
    
    var_dump(STRUCTURE); //[1,2,3]
}


//Проверка существования константы
var_dump(defined("STRUCTURE")); //true

echo MY_CONST; //Выведет 1