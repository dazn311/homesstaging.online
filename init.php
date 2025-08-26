<?php
// ini_set("session.cookie_secure", 1);
// $cookieParams = session_get_cookie_params();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Теперь переменные из .env доступны
$databaseUrl = $_ENV['DATABASE_URL'];




