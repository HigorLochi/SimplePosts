<?php

namespace app\controllers;

use app\models\UserModel;

class UserController extends AbstractController{
    public $session;
    private $userRepository;

    public function __construct($session, $userRepository) {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function list(){
        $limitPerPage = 10;
        $count = $this->userRepository->countRows();
        $pagesCount = ceil($count / $limitPerPage);
        $page = $this->isValidPage($pagesCount) ? (int) $_GET['page'] : 1;

        $this->render('user/list', [
            'rows' =>  $this->userRepository->fetchAll($limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $limitPerPage,
            'page' => $page,
            'pagesCount' => $pagesCount
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            if($this->userRepository->insert($_POST))
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
            if($this->userRepository->update($_POST))
                $response = "User updated.";
            else 
                $response = "An error has ocurred.";
        }
        
        $this->render('user/form', ['user' =>  $this->userRepository->fetchById($id), 'message' => $response]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->userRepository->deleteById($id);
    }
}