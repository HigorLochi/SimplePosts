<?php

namespace database;

use PDO;
use Exception;

class Migrator{
    private $migrationsPath = __DIR__ . '/migrations/';
    private $allowedFiles = [
        'create_database.sql',
        'create_postimages_table.sql',
        'create_userphotos_table.sql',
        'create_users_table.sql',
        'create_posts_table.sql'
    ];

    public function __construct(private PDO $pdo) {}

    public function migrate(){
        foreach ($this->allowedFiles as $file) {
            $path = $this->migrationsPath . $file;

            if (!realpath($path)) {
                throw new Exception('Invalid migration path');
            }

            $query = $this->pdo->prepare(file_get_contents($path));
            $query->execute();
        }
    }
}