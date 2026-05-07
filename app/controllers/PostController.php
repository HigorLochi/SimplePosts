<?php

namespace app\controllers;

use DateTime;
use app\models\PostModel;

class PostController extends AbstractController{
    public $session;
    private $postRepository;
    private $userRepository;

    public function __construct($session, $postRepository, $userRepository) {
        $this->session = $session;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function list(){
        $limitPerPage = 10;
        $count = $this->postRepository->countRows();
        $pagesCount = ceil($count / $limitPerPage);
        $page = $this->isValidPage($pagesCount) ? (int) $_GET['page'] : 1;

        $this->render('post/list', [
            'rows' =>  $this->postRepository->fetchAll($limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $limitPerPage,
            'page' => $page,
            'pagesCount' => $pagesCount
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            $_POST['iduser'] = (int) $this->session->get('user_id');
            $_POST['createdat'] = new DateTime()->format('Y-m-d H:i:s');

            if($this->postRepository->insert($_POST))
                $response = "Post created.";
            else 
                $response = "An error has ocurred.";
        }

        $this->render('post/form', ['post' =>  new PostModel(), 'message' => $response]);
    }

    public function update(){
        $id = (int) $_GET['id'];
        $response = null;

        if($this->isPostMethod()) {
            $_POST['id'] = $id;

            if($this->postRepository->update($_POST))
                $response = "User updated.";
            else 
                $response = "An error has ocurred.";
        }
        
        $this->render('user/form', ['user' =>  $this->postRepository->fetchById($id), 'message' => $response]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->postRepository->deleteById($id);
    }
}