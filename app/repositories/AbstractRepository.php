<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;

abstract class AbstractRepository{
    private $tableName;
    protected PDO $pdo;
    protected $queryBuilder;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->queryBuilder = new QueryBuilder();
    }
}