<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;
use app\models\PostImageModel;

class PostImageRepository extends AbstractRepository{
    private $tableName = 'postimages';

    public function fetchById(int $id): PostImageModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->where(['id'])
                ->getQuery()
            );

        $query->bindValue(":id", $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, PostImageModel::class);

        return $query->fetch();
    }

    public function fetchByIdPost(int $idpost): PostImageModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->where(['idpost'])
                ->getQuery()
            );

        $query->bindValue(":idpost", $idpost);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, PostImageModel::class);

        return $query->fetch();
    }

    public function insert($image): int|bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->insert(['idpost', 'filename', 'extension'])
                    ->getQuery()
                );

            $query->bindValue(':idpost', $image['idpost'], PDO::PARAM_INT);
            $query->bindValue(':filename', $image['filename']);
            $query->bindValue(':extension', $image['extension']);

            $query->execute();

            return $this->pdo->lastInsertId();
        }catch(Exception $e){
            return false;
        }
    }

    public function update(array $image): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->update(['filename', 'extension'])
                    ->where(['id'])
                    ->getQuery()
                );

            $query->bindValue(':id', $image['id'], PDO::PARAM_INT);
            $query->bindValue(':filename', $image['filename']);
            $query->bindValue(':extension', $image['extension']);

            $query->execute();

            return true;
        }catch(Exception $e){            
            return false;
        }
    }
}