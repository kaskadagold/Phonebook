<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

define('APP_DIR', dirname(__DIR__));

require_once APP_DIR . '/vendor/autoload.php';
require_once APP_DIR . '/bootstrap.php';

use App\Application;
use App\Controllers\PagesController;
use App\Router;
use Symfony\Component\HttpFoundation\Request;

$router = new Router();

$router->get('/', [PagesController::class, 'home']);

$router->get('/create', [PagesController::class, 'create']);
$router->post('/create', [PagesController::class, 'submitCreate']);

$router->get('/update/*', [PagesController::class, 'update']);
$router->post('/update/*', [PagesController::class, 'submitUpdate']);

$router->post('/delete/*', [PagesController::class, 'delete']);

$application = new Application($router);
$responce = $application->run(Request::createFromGlobals());

$responce->send();
