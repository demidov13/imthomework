<?php
$filename = 'risovach.ru.jpg';
// тип содержимого
$percent = 0.5;

// получение новых размеров
list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

// ресэмплирование
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// вывод
imagejpeg($image_p, 'croped.jpg', 100);