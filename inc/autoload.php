<?php

spl_autoload_register(function($class){
    $filepath = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($filepath)){
        require $filepath;
    }
});