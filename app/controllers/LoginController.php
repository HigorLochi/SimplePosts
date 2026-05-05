<?php

namespace app\controllers;

use app\services\Session;
use app\models\UserRepository;

class LoginController extends AbstractController{
    public function __construct(Session $session, UserRepository $userRepository) {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userRepository->fetchByEmail($_POST['email']);

            if($user && password_verify($_POST['password'], $user->getPassword())) {
                $this->session->set('user_id', $user->getId());
                $this->session->set('user_email', $user->getEmail());
                
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }

        $this->render('login', []);
    }
}