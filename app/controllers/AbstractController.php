<?php

namespace app\controllers;

use app\services\Session;

abstract class AbstractController{
    protected $session;
    protected $sessionInfo;
    protected $limitPerPage = 10;

    private $viewsPath = "../../views/";

    public function __construct(Session $session)
    {
        $this->session = $session;

        $this->sessionInfo = [
            'user_id' => $session->get('user_id'),
            'user_name' => $session->get('user_name'),
            'user_admin' => $session->get('user_admin')
        ];
    }
    
    protected function render(string $view, array $params){
        extract($params, EXTR_SKIP);

        ob_start();

        if(!$this->isViewLogin($view)) require __DIR__ . $this->viewsPath . 'upperbar.php';
        
        require __DIR__ . $this->viewsPath . $view . '.php';

        $contents = ob_get_clean();

        require __DIR__ . $this->viewsPath . 'layout.php';
    }

    protected function getSessionInfo(): array{
        return $this->sessionInfo;
    }

    protected function isValidPage($pagesCount){
        return (isset($_GET['page']) && (int) $_GET['page'] > 0 && (int) $_GET['page'] <= $pagesCount);
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