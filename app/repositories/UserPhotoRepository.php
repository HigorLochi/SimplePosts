<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;

class UserPhotoRepository extends AbstractRepository{
    private $tableName = 'userphotos';

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