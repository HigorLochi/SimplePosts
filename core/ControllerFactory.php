<?php

namespace core;

use PDO;
use app\services\Session;
use app\controllers\LoginController;
use app\controllers\PostController;
use app\controllers\UserController;
use app\controllers\NotFoundController;
use app\repositories\PostRepository;
use app\repositories\UserRepository;

class ControllerFactory {
    public function __construct(
        private Session $session,
        private PDO $connection
    ){}

    public function create(string $controllerName) {
        return match ($controllerName) {
            'PostController' => new PostController($this->session, new PostRepository($this->connection), new UserRepository($this->connection)),
            'UserController' => new UserController($this->session, new UserRepository($this->connection)),
            'LoginController' => new LoginController($this->session,new UserRepository($this->connection)),
            default => new NotFoundController($this->session)
        };
    }
}