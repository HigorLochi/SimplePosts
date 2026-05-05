<?php

namespace controllers;

use services\Session;
use models\UserRepository;

class LoginController extends AbstractController{
    public function __construct(Session $session, UserRepository $userRepository) {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$user = $userRepository->fetchByField();
        }

        $this->render('login', []);
    }
}