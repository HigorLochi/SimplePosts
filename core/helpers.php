<?php

spl_autoload_register(function($class){
    $filepath = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($filepath)){
        require $filepath;
    }
});

function protectedVariableText($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function limitText($string, $limit){
    return (strlen($string) > $limit) ? substr($string, 0, $limit) . '...' : $string;
}