<?php

namespace app\models;

class UserModel{
    private int $id = 0; 
    private string $name = "";
    private string $email = "";
    private string $password = "";
    private bool $isadmin = false;
    private ?int $idphoto = null;

    public function __construct(){}

    // public function __construct(string $name, string $email, string $password, bool $admin, int $idphoto){
    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->password = password_hash($password);
    //     $this->admin = $admin;
    //     $this->idphoto = $idphoto;
    // }

    // GETTERS
    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function isAdmin(): bool{
        return $this->isadmin;
    }

    public function getIdPhoto(): int{
        return $this->idphoto;
    }

    // SETTERS
    public function setName(string $name): void{
        $this->name = $name;
    }

    public function setEmail(string $email): void{
        $this->email = $email;
    }
}