<?php

namespace app\services;

class FileUploader{
    private $uploadPaths = [
        'user' => "../../storage/userphotos/",
        'post' => "../../storage/postimages/"
    ];

    private $validExtensions = ["jpg", "png", "jpeg"];

    public function upload(string $tempFileName, string $targetFileName, string $type): bool{
        $tmpFile = $_FILES[$tempFileName]["tmp_name"];
        $targetFile = $uploadPaths[$type] . $targetFileName;

        $fileExtension = strtolower(pathinfo($tmpFile,PATHINFO_EXTENSION));

        if(!$this->isValidFile($tmpFile) || !$this->isValidExtension($fileExtension)) 
            return false;    
        
        return (move_uploaded_file($tmpFile, $targetFile . $fileExtension));
    }

    private function isValidExtension($extension): bool{
        return (in_array($extension, $this->validExtensions));
    }

    private function isValidFile($file){
        return (getimagesize($file));
    }
}