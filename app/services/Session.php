<?php

namespace app\services;

use DateTime;

class Session{
    public function create(): void{
        if(!$this->isCreated())
            session_start();
    }

    public function unset(): void{
        if($this->isCreated())
            session_unset();
    }

    public function set(string $property, string $value): void{
        if($this->isCreated()) 
            $_SESSION[$property] = $value;
    }

    public function get(string $property){
        if($this->isCreated() && isset($_SESSION[$property])) 
            return $_SESSION[$property];
        else 
            return null;
    }

    public function isCreated(): bool{
        return !(session_status() === PHP_SESSION_NONE);
    }

    public function isAuthenticated(): bool{
        return $this->get('user_id') !== null;
    }
}