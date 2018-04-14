<?php

function render($view, $params)
{
    global $content;
    ob_start();
    $viewPath = './views/'.$view.'.php';
    if(file_exists($viewPath)){
        require_once($viewPath);
        $content = ob_get_clean();
    }
}