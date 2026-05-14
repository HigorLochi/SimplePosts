<?php

namespace app\models;

class PostImageModel{
    private int $id = 0; 
    private string $filename = ""; 
    private string $extension = ""; 

    public function __construct(){}

    // GETTERS
    public function getId(): int{
        return $this->id;
    }

    public function getFilename(): int{
        return $this->filename;
    }

     public function getExtension(): int{
        return $this->extension;
    }
}