<?php

namespace app\repositories;

use PDO;
use app\models\PostModel;

class PostRepository extends AbstractRepository{
    private $tableName = 'posts';

    public function __construct(private PDO $pdo) {}

    public function fetchAll(int $limit, int $page): array {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY createdat" . $this->limit($limit, $page));
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, PostModel::class);

        return $query->fetchAll();
    }

    public function countRows(): int {
        $query = $this->pdo->prepare("SELECT COUNT(id) AS count FROM $this->tableName");
        $query->execute();

        return $query->fetch()['count'];
    }

    public function insert(array $post): bool {
        try{
            $query = $this->pdo->prepare("INSERT INTO $this->tableName(iduser, title, text, createdat) VALUES(:iduser, :title, :text, :createdat)");

            $query->bindValue(':iduser', $post['iduser'], PDO::PARAM_INT);
            // $query->bindValue(':idimage', $post['idimage'], PDO::PARAM_INT);
            $query->bindValue(':title', $post['title']);
            $query->bindValue(':text', $post['text']);
            $query->bindValue(':createdat', $post['createdat']);

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