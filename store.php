<?php
define('DIR_DB', dirname(__DIR__).'/db');
define('FL_DATA', DIR_DB.'/data.json');

_init();

function _init()
{
    if(!is_dir(DIR_DB)){
        mkdir(DIR_DB);
    }
    if(!file_exists(FL_DATA)){
        file_put_contents(FL_DATA, '');
    }
}

function save($data)
{
    if(!is_array($data)){
        return false;
    }
    $str = file_get_contents(FL_DATA);
    $items = json_decode($str, true);
    $items[] = $data;
    return file_put_contents(FL_DATA, json_encode($items));
}

function findAll()
{
    $str = file_get_contents(FL_DATA);
    return json_decode($str, true);
}

function findby($email)
{
    $items = findAll();
    foreach($items as $item){
        if($item['email'] == $email){
            return $item;
        }
    }
}