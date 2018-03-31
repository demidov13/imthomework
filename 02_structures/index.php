<?php

//Индексированный массив
$x1 = [1, 2, 3, 4];//Краткое определение массива
$x2 = array(1,2,3,4);
$x3 = [1,2,3,4, ['a', 'b', 'c', 'd']]; //Многомерный массив (когда один массив вложен в другой)

var_dump($x1);
var_dump($x2);
var_dump($x3);

echo $x1[2]; //Выведет 3
var_dump($x3[4]);//Выведет array ['a', 'b', 'c', 'd']


//ассоциативный массив
$y1 = ['firstName' => 'Oleg', 'lastName' => 'Ivanov']; //Краткое определение массива
$y2 = array('firstName' => 'Oleg', 'lastName' => 'Ivanov');


//Многомерный ассоциативный массив
$y3 = [
    'firstName' => 'Oleg', 
    'lastName' => 'Ivanov',
    'company' => [
        'name' => 'IMT',
    ]
];

var_dump($y1);
var_dump($y2);
var_dump($y3);

echo $y1['firstName']; //Выведет Oleg
var_dump($y3['company']); // array['name' => 'IMT']

$obj = new stdClass();
$obj->firstName = "Oleg";
$obj->lastName = "Ivanov";

var_dump($obj);

echo $obj->firstName; //Выведет Oleg