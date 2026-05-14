<?php

namespace app\controllers;

use app\models\UserModel;

class UserController extends AbstractController{
    private $userRepository;
    private $userPhotoRepository;
    private $fileUploader;

    public function __construct($session, $userRepository, $userPhotoRepository, $fileUploader) {
        parent::__construct($session);
        
        $this->userRepository = $userRepository;
        $this->userPhotoRepository = $userPhotoRepository;
        $this->fileUploader = $fileUploader;
    }

    public function list(){
        $count = $this->userRepository->countRows();
        $pagesCount = ceil($count / $this->limitPerPage);
        $page = $this->isValidPage($pagesCount) ? (int) $_GET['page'] : 1;

        $this->render('user/list', [
            'rows' =>  $this->userRepository->fetchAll($this->limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $this->limitPerPage,
            'page' => $page,
            'pagesCount' => $pagesCount,
            'sessionInfo' => $this->getSessionInfo(),
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            $userInsertedId = $this->userRepository->insert($_POST);

            if($_FILES) $this->upload($userInsertedId);

            $response = ($userInsertedId) ? "User created." : "An error has ocurred.";
        }

        $this->render('user/form', [
            'user' =>  new UserModel(),
            'photoPath' => $this->fileUploader->getWebStoragePath("user"),
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function update(){
        $id = (int) $_GET['id'];
        $response = null;

        if($this->isPostMethod()) {
            $_POST['id'] = $id;

            if($_FILES) $this->upload($id);

            $response = $this->userRepository->update($_POST) ? "User updated." : "An error has ocurred.";
        }
        
        $this->render('user/form', [
            'user' =>  $this->userRepository->fetchById($id), 
            'photoPath' => $this->fileUploader->getWebStoragePath("user"),
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->userRepository->deleteById($id);
    }

    public function upload($iduser): bool{
        $photo = $this->userPhotoRepository->fetchByIdUser($iduser);

        if(!$photo) {
            $idPhoto = $this->userPhotoRepository->insert([
                'iduser' => $iduser, 
                'filename' => '', 
                'extension' => ''
            ]);

            $photo = $this->userPhotoRepository->fetchById($idPhoto);
        }

        $photoData = $this->fileUploader->upload("photo", "user");
        if(!$photoData) return false;

        $this->userPhotoRepository->update(array_merge($photoData, ['id' => $photo->getId()]));

        return true;
    }
}