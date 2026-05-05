<?php

namespace app\controllers;

use app\services\Session;

class LogoutController extends AbstractController{
    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function login(){
        $this->session->destroy();

        $this->render('login', []);
    }
}