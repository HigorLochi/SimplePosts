<?php

namespace app\models;

class UserModel extends AbstractModel{
    private int $id = 0; 
    private string $name = "";
    private string $email = "";
    private string $password = "";
    private bool $isadmin = false;

    public function __construct(){}

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

    // SETTERS
    public function setName(string $name): void{
        $this->name = $name;
    }

    public function setEmail(string $email): void{
        $this->email = $email;
    }
}