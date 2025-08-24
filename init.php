<?php
// ini_set("session.cookie_secure", 1);
// $cookieParams = session_get_cookie_params();
session_start();

//use Utils\Router;

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';
require CONFIG . '/routes.php';

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Теперь переменные из .env доступны
$databaseUrl = $_ENV['DATABASE_URL'];




