<?php

namespace app\controllers;

use DateTime;
use app\models\PostModel;

class PostController extends AbstractController{
    private $postRepository;

    public function __construct($session, $postRepository) {
        parent::__construct($session);

        $this->postRepository = $postRepository;
    }

    public function single(){
        $id = (int) $_GET['id'];
        
        $this->render('post/single', [
            'post' =>  $this->postRepository->fetchById($id), 
            'sessionInfo' => $this->getSessionInfo()
        ]);
    }

    public function list(){
        $count = $this->postRepository->countRows();
        $pagesCount = ceil($count / $this->limitPerPage);
        $page = $this->isValidPage($pagesCount) ? (int) $_GET['page'] : 1;

        $this->render('post/list', [
            'rows' =>  $this->postRepository->fetchAll($this->limitPerPage, $page),
            'count' =>  $count,
            'limitPerPage' => $this->limitPerPage,
            'page' => $page,
            'pagesCount' => $pagesCount,
            'sessionInfo' => $this->getSessionInfo()
        ]);
    }

    public function insert(){
        $response = null;

        if($this->isPostMethod()) {
            if($this->postRepository->insert(array_merge($_POST, [
                'iduser' => (int) $this->session->get('user_id'),
                'createdat' => new DateTime()->format('Y-m-d H:i:s')
            ])))
                $response = "Post created.";
            else 
                $response = "An error has ocurred.";
        }

        $this->render('post/form', [
            'post' =>  new PostModel(), 
            'sessionInfo' => $this->getSessionInfo(),
            'message' => $response
        ]);
    }

    public function delete(){
        $id = (int) $_POST['id'];
        $this->postRepository->deleteById($id);
    }
}