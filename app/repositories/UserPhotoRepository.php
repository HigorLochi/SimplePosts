<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;
use app\models\UserPhotoModel;

class UserPhotoRepository extends AbstractRepository{
    private $tableName = 'userphotos';

    public function fetchByIdUser(int $iduser): UserPhotoModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->where(['iduser'])
                ->getQuery()
            );

        $query->bindValue(":iduser", $iduser);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserPhotoModel::class);

        return $query->fetch();
    }

    public function insert(array $photo): int|bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->insert(['iduser', 'filename', 'extension'])
                    ->getQuery()
                );

            $query->bindValue(':iduser', $photo['iduser'], PDO::PARAM_INT);
            $query->bindValue(':filename', $photo['filename']);
            $query->bindValue(':extension', $photo['extension']);

            $query->execute();

            return $this->pdo->lastInsertId();
        }catch(Exception $e){
            return false;
        }
    }

    public function update(array $photo): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->update(['filename', 'extension'])
                    ->where(['id'])
                    ->getQuery()
                );

            $query->bindValue(':id', $photo['id'], PDO::PARAM_INT);
            $query->bindValue(':filename', $photo['filename']);
            $query->bindValue(':extension', $photo['extension']);

            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }
}