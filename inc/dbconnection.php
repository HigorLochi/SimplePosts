<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=simple_posts;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch(Exception $e){
    $pdo = new PDO('mysql:host=localhost;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $migration = new database\Migration($pdo);
    $migration->migrate();

    $pdo->exec("USE simple_posts");
}