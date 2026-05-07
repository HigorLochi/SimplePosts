<?php

namespace app\models;

class UserPhotoModel{
    private int $id = 0; 

    public function __construct(){}

    // GETTERS
    public function getId(): int{
        return $this->id;
    }
}