<?php

namespace core;

use PDO;
use PDOException;

class ConnectionCreator{
    private $host = "localhost";
    private $database = "simple_posts";
    private $charset = "utf8mb4";
    private $username = "root";
    private $password = "";

    public function __construct() {}

    public function create(bool $database = true): PDO{
        try{
            return new PDO($this->connectionString($database), $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }catch(PDOException $e){
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function connectionString(bool $database = true): string{
        return ($database) ? "mysql:host=$this->host;dbname=$this->database;charset=$this->charset" : "mysql:host=$this->host;charset=$this->charset";
    }
}