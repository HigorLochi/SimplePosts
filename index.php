<?php

require __DIR__ . '/inc/htmlspecialchars.php';
require __DIR__ . '/inc/autoload.php';

$connectionCreator = new core\ConnectionCreator();

$migrator = new database\Migrator($connectionCreator->create(false));
$migrator->migrate();

$pdo = $connectionCreator->create(true);

$session = new services\Session();

if(session_status() === PHP_SESSION_NONE){
    $loginController = new controllers\LoginController($session, new models\UserRepository($pdo));
    $loginController->login();
}else{
    // $notFoundController = new controllers\NotFoundController();

    // $urlController = ucfirst($_GET['controller'] ?? 'user');

    // $controllerName = $urlController . 'Controller';
    // $repositoryName = $urlController . 'Repository';

    // $action = $_GET['action'] ?? 'list';

    // if($action == 'update' && (int) $_GET['id'] <= 0) 
    //     $action = 'list';

    // if (!file_exists("controllers/$controllerName.php")) {
    //     $notFoundController->error();
    // }

    // $controllerClass = "Controllers\\$controllerName";
    // $repositoryClass = "Models\\$repositoryName";

    // $repository = new $repositoryClass($pdo);
    // $controller = new $controllerClass($repository);

    // if (!method_exists($controller, $action)) {
    //     $notFoundController->error();
    // }

    // $controller->$action();
}