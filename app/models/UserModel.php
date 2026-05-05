<?php

namespace app\models;

class UserModel{
    private int $id; 
    private string $name;
    private string $email;
    private string $password;
    private bool $isadmin;
    private ?int $idphoto;

    public function __construct(){}

    // public function __construct(string $name, string $email, string $password, bool $admin, int $idphoto){
    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->password = password_hash($password);
    //     $this->admin = $admin;
    //     $this->idphoto = $idphoto;
    // }

    // GETTERS
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function isAdmin(){
        return $this->admin;
    }

    public function getIdPhoto(){
        return $this->idphoto;
    }

    // SETTERS
    public function setName(string $name){
        $this->name = $name;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }
}