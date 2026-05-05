<?php

require __DIR__ . '/inc/htmlspecialchars.php';
require __DIR__ . '/inc/autoload.php';

$session = new app\services\Session();
$session->create();

if(isset($_GET['logout'])) 
    $session->unset();

$connectionCreator = new core\ConnectionCreator();

try{
    $connection = $connectionCreator->createWithDatabase();
}catch(PDOException $e){
    $connection = $connectionCreator->createWithoutDatabase();

    (new database\Migrator($connection))->migrate();

    $connection = $connectionCreator->createWithDatabase();
}

if(!$session->get('user_id')){
    $loginController = new app\controllers\LoginController($session, new app\models\UserRepository($connection));
    $loginController->login();
}else{
    $notFoundController = new app\controllers\NotFoundController();
    $notFoundController->error();

    $urlController = ucfirst($_GET['controller'] ?? 'post');

    $controllerName = $urlController . 'Controller';
    $repositoryName = $urlController . 'Repository';

    $action = $_GET['action'] ?? 'list';

    if($action == 'update' && (int) $_GET['id'] <= 0) 
        $action = 'list';

    if (!file_exists("app/controllers/$controllerName.php")) {
        $notFoundController->error();
    }

    $controllerClass = "App\\Controllers\\$controllerName";
    $repositoryClass = "App\\Models\\$repositoryName";

    $repository = new $repositoryClass($connection);
    $controller = new $controllerClass($repository);

    if (!method_exists($controller, $action)) {
        $notFoundController->error();
    }

    $controller->$action();
}