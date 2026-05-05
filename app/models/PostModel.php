<?php

namespace app\models;

class UserModel{
    private int $id; 
    private string $iduser;
    private ?string $idimage;
    private string $title;
    private string $text;


    public function __construct(){}

    // GETTERS
    public function getId(){
        return $this->id;
    }

    public function getIdUser(){
        return $this->iduser;
    }

    public function getIdImage(){
        return $this->idimage;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getText(){
        return $this->text;
    }

    // SETTERS
    public function setIdUser(int $iduser){
        $this->iduser = $iduser;
    }

    public function setIdImage(int $idimage){
        $this->idimage = $idimage;
    }

    public function setTitle(int $title){
        $this->title = $title;
    }

    public function setText(int $text){
        $this->text = $text;
    }
}