<?php

namespace app\repositories;

use PDO;
use app\models\UserModel;

class UserRepository extends AbstractRepository{
    private $tableName = 'users';

    public function __construct(private PDO $pdo) {}

    public function fetchAll(int $limit, int $page): array {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY name" . $this->limit($limit, $page));
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetchAll();
    }

    public function fetchById(int $id): UserModel|bool {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetch();
    }

    public function fetchByEmail(string $email): UserModel|bool {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetch();
    }

    public function countRows(): int {
        $query = $this->pdo->prepare("SELECT COUNT(id) AS count FROM $this->tableName");
        $query->execute();

        return $query->fetch()['count'];
    }

    public function insert(array $user): bool {
        try{
            $query = $this->pdo->prepare("INSERT INTO $this->tableName(name, email, password, isadmin) VALUES(:name, :email, :password, :isadmin)");

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
            $query = $this->pdo->prepare("UPDATE $this->tableName SET name = :name, email = :email, isadmin = :isadmin WHERE id = :id");

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
            $query = $this->pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
            $query->bindValue(':id', $id);
            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }
}