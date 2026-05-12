<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;

class PostImageRepository extends AbstractRepository{
    private $tableName = 'postimages';

    public function insert(): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->insert([])
                    ->getQuery()
                );

            $query->execute();

            return $this->pdo->lastInsertId();
        }catch(Exception $e){
            return false;
        }
    }
}