<?php

namespace app\controllers;

class NotFoundController extends AbstractController{
    public function error(){
        http_response_code(404);

        $this->render('notfound',[]);
    }
}