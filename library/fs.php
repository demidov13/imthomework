<?php

/**
*
*
*
*/


function upload($filename, $path = null)
{
    if (!$path) {
        $path = dirname(__DIR__) . '/upload';
    }
    if (!is_dir($path)) {
        return false;
    }


    $type = $_FILES['image']['type'];
    $tmpPath = $_FILES['image']['tmp_name'];
    $fullName = generateName($filename, $type);
    if (file_exists($tmpPath)) {
        move_uploaded_file($tmpPath, $path . '/' . $fullName);
        return $fullName;
    }
}

function generateName($name, $type)
{
    $map = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png'
];
    return $name.$map[$type];
}

// function buildUrl($filename)
// {
//     $file = '/upload/'.$filename;

//     mime_content_type()
//     if(file_exists($file))
// }