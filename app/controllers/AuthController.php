<?php

namespace app\controllers;

use app\services\Session;
use app\repositories\UserRepository;

class AuthController extends AbstractController{

    public function __construct(Session $session, UserRepository $userRepository) {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function login(){
        $variables = [];

        if($this->isPostMethod()) {
            $user = $this->userRepository->fetchByEmail($_POST['email']);

            if($user && password_verify($_POST['password'], $user->getPassword())) {
                $this->session->set('user_id', $user->getId());
                $this->session->set('user_name', $user->getName());
                $this->session->set('user_email', $user->getEmail());
                $this->session->set('user_admin', $user->isAdmin());

                header("Location: " . $_SERVER['PHP_SELF']);
            }else{
                $variables['error'] = 'Invalid email or password!';
            }
        }

        $this->render('login', $variables);
    }

    public function logout(){
        $this->session->unset();

        $this->render('login', []);
    }
}