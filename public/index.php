<?php

date_default_timezone_set('America/Los_Angeles');

require __DIR__ . '/../core/helpers.php';

$session = new app\services\Session();
$session->create();

$databaseConnection = new core\DatabaseConnection();

try{
    $connection = $databaseConnection->connectWithDatabase();
}catch(PDOException $e){
    $connection = $databaseConnection->connectWithoutDatabase();

    (new database\Migrator($connection))->migrate();

    $connection = $databaseConnection->connectWithDatabase();
}

$controllerFactory = new core\ControllerFactory($session, $connection);

if(!$session->isAuthenticated()){
    $authController = $controllerFactory->create('AuthController');
    $authController->login();

    exit;
}

$urlController = ucfirst($_GET['controller'] ?? 'post');

$action = $_GET['action'] ?? 'list';

if($action == 'update' && (int) $_GET['id'] <= 0) 
    $action = 'list';

$controller = $controllerFactory->create($urlController . 'Controller');

if (!method_exists($controller, $action)) {
    $controllerFactory->create('NotFoundController')->error();
    
    exit;
}

$controller->$action();