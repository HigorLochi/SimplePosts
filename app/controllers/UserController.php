<?php

namespace app\controllers;

use app\models\UserModel;

class UserController extends AbstractController{
    private $userRepository;

    public function __construct($session, $userRepository) {
        parent::__construct($session);
        
        $this->userRepository = $userRepository;
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
            $response = $this->userRepository->insert($_POST) ? "User created." : "An error has ocurred.";
        }

        $this->render('user/form', [
            'user' =>  new UserModel(), 
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function update(){
        $id = (int) $_GET['id'];
        $response = null;

        if($this->isPostMethod()) {
            $_POST['id'] = $id;
            $response = $this->userRepository->update($_POST) ? "User updated." : "An error has ocurred.";
        }
        
        $this->render('user/form', [
            'user' =>  $this->userRepository->fetchById($id), 
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->userRepository->deleteById($id);
    }
}