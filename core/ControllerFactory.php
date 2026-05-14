<?php

namespace core;

use PDO;
use app\services\Session;
use app\services\FileUploader;
use app\controllers\AuthController;
use app\controllers\PostController;
use app\controllers\UserController;
use app\controllers\NotFoundController;
use app\repositories\PostRepository;
use app\repositories\UserRepository;
use app\repositories\PostImageRepository;
use app\repositories\UserPhotoRepository;

class ControllerFactory {
    public function __construct(
        private Session $session,
        private PDO $connection
    ){}

    public function create(string $controllerName) {
        return match ($controllerName) {
            'PostController' => new PostController(
                $this->session, 
                new PostRepository($this->connection), 
                new PostImageRepository($this->connection), 
                new FileUploader()
            ),
            'UserController' => new UserController(
                $this->session, 
                new UserRepository($this->connection), 
                new UserPhotoRepository($this->connection), 
                new FileUploader()
            ),
            'AuthController' => new AuthController($this->session, new UserRepository($this->connection)),
            default => new NotFoundController($this->session)
        };
    }
}