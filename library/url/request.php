<?php

$rules = [];

$types = [
    'd' => '[0-9]+',
    's' => '[a-zA-Z\.\-_%]+',
    'any' => '[0-9a-zA-Z\.\-_%]+'
];

function addRule($alias, $callback)
{
    global $rules;
    global $types;

    $id = preg_replace_callback('#\{(\w+):(\w+)\}#', function($match)use($types){
        $name = $match[1];
        $pattern = $match[2];

        return '(?<'.$name.'>'.strtr($pattern, $types).')';
    }, $alias);
    $rules[$id] = $callback;
}

function start()
{
    global $rules;
    $uri = $_SERVER['REQUEST_URI'];
    foreach($rules as $pattern => $callback){

        if(preg_match('#'.$pattern.'#', $uri, $params)){
            foreach($params as $k => $v){
                if(is_int($k)){
                    unset($params[$k]);
                }
            }
            $callback($params);
        }
    }
}