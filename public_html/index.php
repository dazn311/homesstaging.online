<?php

use Utils\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';
require CORE . '/funcs.php';


$router = new Router();
require CONFIG . '/routes.php';

try {
    $router->match();
} catch (Exception $e) {
    echo $e->getMessage();
}
