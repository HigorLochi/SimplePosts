<?php

namespace app\repositories;

use PDO;
use database\QueryBuilder;
use app\models\PostModel;

class PostRepository extends AbstractRepository{
    private $tableName = 'posts';

    public function fetchAll(int $limit, int $page): array {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select([
                    $this->tableName . '.*', 
                    'users.name',
                    'users.email',
                    'users.isadmin', 
                    'CONCAT(postimages.filename, ".", postimages.extension) AS postimage',
                    'CONCAT(userphotos.filename, ".", userphotos.extension) AS userphoto'
                ])
                ->join([
                    ['type' => 'INNER', 'leftTable' => $this->tableName, 'leftField' => 'iduser', 'rightTable' => 'users', 'rightField' => 'id'],
                    ['type' => 'LEFT', 'leftTable' => $this->tableName, 'leftField' => 'id', 'rightTable' => 'postimages', 'rightField' => 'idpost'],
                    ['type' => 'LEFT', 'leftTable' => 'users', 'leftField' => 'id', 'rightTable' => 'userphotos', 'rightField' => 'iduser']
                ])
                ->order(["createdat"])
                ->limit($limit, $page)
                ->getQuery()
            );
            
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, PostModel::class);

        return $query->fetchAll();
    }

    public function fetchById(int $id): PostModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select([
                    $this->tableName . '.*', 
                    'users.name',
                    'users.email',
                    'users.isadmin', 
                    'CONCAT(postimages.filename, ".", postimages.extension) AS postimage',
                    'CONCAT(userphotos.filename, ".", userphotos.extension) AS userphoto'
                ])
                ->join([
                    ['type' => 'INNER', 'leftTable' => $this->tableName, 'leftField' => 'iduser', 'rightTable' => 'users', 'rightField' => 'id'],
                    ['type' => 'LEFT', 'leftTable' => $this->tableName, 'leftField' => 'id', 'rightTable' => 'postimages', 'rightField' => 'idpost'],
                    ['type' => 'LEFT', 'leftTable' => 'users', 'leftField' => 'id', 'rightTable' => 'userphotos', 'rightField' => 'iduser']
                ])
                ->where([$this->tableName . '.id'])
                ->getQuery()
            );

        $query->bindValue(":id", $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, PostModel::class);

        return $query->fetch();
    }

    public function countRows(): int {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['COUNT(id) AS count'])
                ->getQuery()
            );

        $query->execute();

        return $query->fetch()['count'];
    }

    public function insert(array $post): int|bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->insert(['iduser', 'title', 'text', 'createdat'])
                    ->getQuery()
                );

            $query->bindValue(':iduser', $post['iduser'], PDO::PARAM_INT);
            $query->bindValue(':title', $post['title']);
            $query->bindValue(':text', $post['text']);
            $query->bindValue(':createdat', $post['createdat']);

            $query->execute();

            return $this->pdo->lastInsertId();
        }catch(Exception $e){
            return false;
        }
    }

    public function deleteById(int $id): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->delete()
                    ->where(['id'])
                    ->getQuery()
                );

            $query->bindValue(':id', $id);

            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }
}