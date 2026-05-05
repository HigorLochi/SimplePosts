<?php

namespace controllers;

abstract class AbstractController{
    protected function render(string $view, array $params){
        extract($params, EXTR_SKIP);

        ob_start();

        if(!$this->isViewLogin($view)) 
            require __DIR__ . '../../views/upperbar.php';
        
        require __DIR__ . '../../views/' . $view . '.php';

        $contents = ob_get_clean();

        require __DIR__ . '../../views/layout.php';
    }

    private function isViewLogin($view){
        return ($view === 'login');
    }
}