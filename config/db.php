<?php

return [
    'host' => 'mysql',
    'dbname' => 'homesStaging',
    'username' => 'root',
    'password' => '12345',
    'charset' => 'utf8mb4', // utf8mb4
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ],
];
