<?php
/**
 * Сгруппировать файлы с расширением *.bk таким образом:
 * 2018
 *     01
 *       01-01-2018.bk
 *       13-01-2018.bk
 *     02
 *       01-02-2018.bk
 * 2017
 *     02
 *       01-02-2017.bk
 *      
 */

$dir = scandir(__DIR__);
$selfDir = __DIR__;
// var_dump(__DIR__);
// var_dump($dir);


foreach($dir as $val){

    if(preg_match('/\.bk$/', $val)){

    $find = preg_match('/(?<day>\d{1,2}).*(?<month>\d{1,2}).*(?<year>\d{4})/', $val, $res);

        if(!is_dir($selfDir."\\".$res['year'])){
        $newYear = $selfDir."\\".$res['year'];
        mkdir($newYear, 0777);
        }
        if(!is_dir($selfDir."\\".$res['year']."\\".$res['month'])){
        $newMonth = $selfDir."\\".$res['year']."\\".$res['month'];
        mkdir($newMonth, 0777);
        }
    $copyFile = $selfDir."\\".$val;
    $copyDir = $selfDir."\\".$res['year']."\\".$res['month']."\\".$val;
    // $newName = preg_replace();

        if (!file_exists($copyDir)){
        copy($copyFile, $copyDir);
        }

    }

}