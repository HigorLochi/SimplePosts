<?php

namespace app\services;

class FileUploader{
    private $uploadPaths = [
        'user' => "/storage/userphotos/",
        'post' => "/storage/postimages/"
    ];

    private $validExtensions = ["jpg", "png", "jpeg"];

    public function upload(string $tempFileName, string $type): array|bool {
        $tmpFile = $_FILES[$tempFileName]["tmp_name"];
        $targetFile = $this->uploadPaths[$type] . basename($_FILES[$tempFileName]["name"]);

        $fileExtension = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if(!$this->fileExists($tmpFile) || !$this->isValidFile($tmpFile) || !$this->isValidExtension($fileExtension)) 
            return false;    

        $targetFileName = (string) strtotime(date("Y-m-d H:i:s"));
        $targetFile = $this->getUploadPath($type) . $targetFileName . '.' .$fileExtension;

        if(move_uploaded_file($tmpFile, $targetFile))
            return ["filename" => $targetFileName, "extension" => $fileExtension];
        else 
            return false;
    }

    public function getWebStoragePath($type): string{
        return ".." . $this->uploadPaths[$type];
    }

    private function getUploadPath($type): string{
        return dirname(__DIR__) . "/.." . $this->uploadPaths[$type];
    }

    private function fileExists($file){
        return (bool) (file_exists($file));
    }

    private function isValidExtension($extension): bool{
        return (in_array($extension, $this->validExtensions));
    }

    private function isValidFile($file): bool{
        return (bool)(getimagesize($file));
    }
}