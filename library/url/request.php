<?php

$rules = [];

$types = [
    'd' => '[0-9]+',
    's' => '[a-zA-Z\.\-_%]+',
    'any' => '[0-9a-zA-Z\.\-_%]+'
];

/**
* @param string $alias псевдоним action
* @param string $routeName имя для рулеса, чтоб его потом найти
* @param callable $callback анонимная функция обратного вызова, 
*        которая будет вызвана, если rule найден
*/

function addRule($alias, $routeName, $callback)
{
    global $rules;
    global $types;

    $pattern = preg_replace_callback('#\{(\w+):(\w+)\}#', function($match)use($types){
        $name = $match[1];
        $regex = $match[2];

        return '(?<'.$name.'>'.strtr($regex, $types).')';
    }, $alias);
    $rules[$routeName] = [
        'pattern' => $pattern,
        'callback' => $callback
    ];
    
}

function start()
{
    global $rules;
    $uri = $_SERVER['REQUEST_URI'];
    foreach($rules as $rule){

        if(preg_match('#'.$rule['pattern'].'#', $uri, $params)){
            foreach($params as $k => $v){
                if(is_int($k)){
                    unset($params[$k]);
                }
            }
            $rule['callback']($params);
        }
    }
}

//about
/**
* Строит url по правилам rules. Например view с параметрами [id => 1]
* @param string $routName имя рулеса в методе addRule
* @param array $params массив параметров, по которым будет строиться URL
*/
function buildUrl($routeName, $params)
{
    global $rules;
    if(isset($rules[$routeName])){

    }

}