<?php

namespace app\models;

class PostModel extends AbstractModel{
    private int $id = 0; 
    private string $iduser = "";
    private string $title = "";
    private string $text = "";
    private string $createdat;

    public function __construct(){}

    // GETTERS
    public function getId(): int{
        return $this->id;
    }

    public function getIdUser(): int{
        return $this->iduser;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function getText(): string{
        return $this->text;
    }

    public function getCreatedAt(): string{
        return $this->createdat;
    }

    // SETTERS
    public function setIdUser(int $iduser): void{
        $this->iduser = $iduser;
    }

    public function setTitle(int $title): void{
        $this->title = $title;
    }

    public function setText(int $text): void{
        $this->text = $text;
    }
}