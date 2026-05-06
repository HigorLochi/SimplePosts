<?php

namespace app\controllers;

use app\models\UserModel;

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
        $page = (isset($_GET['page']) && (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        $count = $this->postRepository->countRows();

        $this->render('post/list', [
            'rows' =>  $this->postRepository->fetchAll($limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $limitPerPage,
            'page' => $page,
            'pagesCount' => ceil($count / $limitPerPage)
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            if($this->postRepository->insert($_POST))
                $response = "User created.";
            else 
                $response = "An error has ocurred.";
        }

        $this->render('user/form', ['user' =>  new UserModel(), 'message' => $response]);
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