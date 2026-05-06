<?php

namespace app\controllers;

abstract class AbstractController{
    private $viewsPath = "../../views/";
    
    protected function render(string $view, array $params){
        extract($params, EXTR_SKIP);

        ob_start();

        if(!$this->isViewLogin($view)) require __DIR__ . $this->viewsPath . 'upperbar.php';
        
        require __DIR__ . $this->viewsPath . $view . '.php';

        $contents = ob_get_clean();

        require __DIR__ . $this->viewsPath . 'layout.php';
    }

    protected function isGetMethod(){
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }

    protected function isPostMethod(){
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    private function isViewLogin($view){
        return ($view === 'login');
    }
}