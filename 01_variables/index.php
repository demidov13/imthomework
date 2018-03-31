<?php

//Числовой тип данных или int
$x = 1; 
var_dump($x);

$z = 1.1;//Число с плавающей точкой или float
var_dump($z);

$firstName = "Oleg"; //Это строковой тип, или string
$lastName = 'Ivanov'; //Это тоже стрковой тип, или string.

$greeting = "Мое имя: $firstName $lastName"; //Двойные кавычки позволяют "парсить" переменные.
//Будет выведено: Мое имя: Oleg Ivanov.
var_dump($greeting);

$greeting = 'Мое имя: $firstName $lastName'; //Одинарные кавычки не будут "парсить" переменные. Работают быстрее двойных
//Будет выведено: Мое имя: $firstName $lastName.
var_dump($greeting);

$isActive = false;//bool тип данных
var_dump($isActive); //Будет выведено false



