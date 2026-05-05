<?php

namespace models;

use PDO;

class UserRepository extends AbstractRepository{
    public function __construct(private PDO $pdo) {}

    public function fetchAll(int $limit, int $page): array {
        $query = $this->pdo->prepare("SELECT * FROM users ORDER BY name" . $this->buildPaginationQuery($limit, $page));
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetchAll();
    }

    public function fetchByField(string $field, $value): UserModel {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE $field = :$field");
        $query->bindValue(":$field", $value);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, UserModel::class);

        return $query->fetch();
    }

    public function countRows(): int {
        $query = $this->pdo->prepare("SELECT COUNT(id) AS count FROM users");
        $query->execute();

        return $query->fetch()['count'];
    }

    public function insert(array $user): bool {
        try{
            $query = $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");

            $query->bindValue(':name', $user['name']);
            $query->bindValue(':email', $user['email']);
            $query->bindValue(':password', password_hash($user['password']));

            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update(array $user): bool {
        try{
            $query = $this->pdo->prepare("UPDATE users SET name = :name, birthdate = :birthdate, phone = :phone, email = :email, postalcode = :postalcode WHERE id = :id");

            $query->bindValue(':id', $user['id']);
            $query->bindValue(':name', $user['name']);
            $query->bindValue(':email', $user['email']);

            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function deleteById(int $id): bool {
        try{
            $query = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $query->bindValue(':id', $id);
            $query->execute();

            return true;
        }catch(Exception $e){
            return false;
        }
    }
}