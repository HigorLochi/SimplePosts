<?php

namespace services;

class Session{
    public function create(int $id, int $email): void{
        session_start();

        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["created_at"] = new Date();
    }

    public function destroy(): void{
        session_destroy();
    }
}