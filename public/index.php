<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoloading via Composer
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../config/Routes.php";

use App\Core\Router;

$router = new Router($routes);
$router->start();
