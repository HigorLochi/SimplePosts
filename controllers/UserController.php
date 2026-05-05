<?php

namespace controllers;

use models\UserModel;

class UserController extends AbstractController{
    private $userRepository;

    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }

    public function list(){
        $limitPerPage = 10;
        $page = (isset($_GET['page']) && (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        $count = $this->userRepository->countRows();

        $this->render('user/list', [
            'rows' =>  $this->userRepository->fetchAll($limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $limitPerPage,
            'page' => $page,
            'pagesCount' => ceil($count / $limitPerPage)
        ]);
    }

    public function insert(){
        $response = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
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