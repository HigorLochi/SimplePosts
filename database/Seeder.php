<?php

namespace database;

use PDO;
use Exception;

class Seeder{
    private $seedersPath = __DIR__ . '/seeders/';
    private $allowedFiles = [
        'insert_into_users.sql'
    ];

    public function __construct(private PDO $pdo) {}

    public function seed(){
        foreach ($this->allowedFiles as $file) {
            $path = $this->seedersPath . $file;

            if (!realpath($path)) {
                throw new Exception('Invalid migration path');
            }

            $query = $this->pdo->prepare(file_get_contents($path));
            $query->execute();
        }
    }
}