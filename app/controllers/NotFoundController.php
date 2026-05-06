<?php

namespace app\controllers;

class NotFoundController extends AbstractController{
    public $session;

    public function __construct($session) {
        $this->session = $session;
    }

    public function error(){
        http_response_code(404);

        $this->render('notfound',[]);
    }
}