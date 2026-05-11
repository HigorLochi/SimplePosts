<?php

namespace app\repositories;

use PDO;
use app\models\UserModel;

class UserRepository extends AbstractRepository{
    private $tableName = 'users';

    public function fetchAll(int $limit, int $page): array {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->order(["name"])
                ->limit($limit, $page)
                ->getQuery()
            );
            
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetchAll();
    }

    public function fetchById(int $id): UserModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->where(['id'])
                ->getQuery()
            );

        $query->bindValue(":id", $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetch();
    }

    public function fetchByEmail(string $email): UserModel|bool {
        $query = $this->pdo->prepare(
            $this->queryBuilder
                ->table($this->tableName)
                ->select(['*'])
                ->where(['email'])
                ->getQuery()
            );

        $query->bindValue(":email", $email);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

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

    public function insert(array $user): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->insert(['name', 'email', 'password', 'isadmin'])
                    ->getQuery()
                );

            $query->bindValue(':name', $user['name']);
            $query->bindValue(':email', $user['email']);
            $query->bindValue(':password', password_hash($user['password'], PASSWORD_DEFAULT));
            $query->bindValue(':isadmin', $user['isadmin'], PDO::PARAM_BOOL);

            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update(array $user): bool {
        try{
            $query = $this->pdo->prepare(
                $this->queryBuilder
                    ->table($this->tableName)
                    ->update(['name', 'email', 'isadmin'])
                    ->where(['id'])
                    ->getQuery()
                );

            $query->bindValue(':id', $user['id'], PDO::PARAM_INT);
            $query->bindValue(':name', $user['name']);
            $query->bindValue(':email', $user['email']);
            $query->bindValue(':isadmin', $user['isadmin'], PDO::PARAM_BOOL);

            $query->execute();

            return true;
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