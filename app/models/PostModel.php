<?php

namespace app\models;

class PostModel{
    private int $id; 
    private string $iduser;
    private ?string $idimage;
    private string $title;
    private string $text;
    private DateTime $createdat;

    public function __construct(){}

    // GETTERS
    public function getId(): int{
        return $this->id;
    }

    public function getIdUser(): int{
        return $this->iduser;
    }

    public function getIdImage(): int{
        return $this->idimage;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function getText(): string{
        return $this->text;
    }

    public function getCreatedAt(): DateTime{
        return $this->createdat;
    }

    // SETTERS
    public function setIdUser(int $iduser): void{
        $this->iduser = $iduser;
    }

    public function setIdImage(int $idimage): void{
        $this->idimage = $idimage;
    }

    public function setTitle(int $title): void{
        $this->title = $title;
    }

    public function setText(int $text): void{
        $this->text = $text;
    }
}