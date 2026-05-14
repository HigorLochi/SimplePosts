<?php

namespace app\controllers;

use DateTime;
use app\models\PostModel;

class PostController extends AbstractController{
    private $postRepository;
    private $postImageRepository;
    private $fileUploader;

    public function __construct($session, $postRepository, $postImageRepository, $fileUploader) {
        parent::__construct($session);

        $this->postRepository = $postRepository;
        $this->postImageRepository = $postImageRepository;
        $this->fileUploader = $fileUploader;
    }

    public function single(){
        $id = (int) $_GET['id'];
        
        $this->render('post/single', [
            'post' =>  $this->postRepository->fetchById($id), 
            'imagePath' => $this->fileUploader->getWebStoragePath("post"),
            'photoPath' => $this->fileUploader->getWebStoragePath("user"),
            'sessionInfo' => $this->getSessionInfo()
        ]);
    }

    public function list(){
        $count = $this->postRepository->countRows();
        $pagesCount = ceil($count / $this->limitPerPage);
        $page = $this->isValidPage($pagesCount) ? (int) $_GET['page'] : 1;

        $this->render('post/list', [
            'rows' =>  $this->postRepository->fetchAll($this->limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $this->limitPerPage,
            'page' => $page,
            'pagesCount' => $pagesCount,
            'imagePath' => $this->fileUploader->getWebStoragePath("post"),
            'photoPath' => $this->fileUploader->getWebStoragePath("user"),
            'sessionInfo' => $this->getSessionInfo()
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            $postInsertedId = $this->postRepository->insert(array_merge($_POST, [
                'iduser' => (int) $this->session->get('user_id'),
                'createdat' => new DateTime()->format('Y-m-d H:i:s')
            ]));

            if($_FILES) $this->upload($postInsertedId);

            $response = ($postInsertedId) ? "Post created." : "An error has ocurred.";
        }

        $this->render('post/form', [
            'post' =>  new PostModel(), 
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->postRepository->deleteById($id);
    }

    public function upload($idpost){
        $idImage = $this->postImageRepository->insert([
            'idpost' => $idpost, 
            'filename' => '', 
            'extension' => ''
        ]);

        $imageData = $this->fileUploader->upload("image", "post");
        if(!$imageData) return false;

        $this->postImageRepository->update(array_merge($imageData, ['id' => $idImage]));

        return true;
    }
}