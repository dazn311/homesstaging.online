<?php

use Utils\middleware\{Auth, Guest};

/** @var $router */

const MIDDLEWARE = [
    'auth' => Auth::class,
    'guest' => Guest::class,
];

///uploads/avatars/2025/08/11/avatar-5.png
$router->get('uploads/avatars/\d+/\d+/\d+/avatar-\d+.png','images', 'api/uploads.php');
//chat;
//$router->get('chat','', 'chat/index.php');
$router->get('', '(?<key>details)=(?<id>\w+)', 'pages/details');

//documents
//для отображения сайта
$router->get('', '(?<key>documents)=(?<id>\d+)', 'documents/show');
$router->get('', '(?<key>documents)=(?<id>\w+)', 'documents/index');

//для сохранения измененных данных;
$router->post('', '(?<key>documents)=(?<id>\d+)', 'documents/store');

$router->post('', '(?<key>documents)=(create)', 'documents/create')->only('auth');
$router->delete('', '(?<key>documents)=(?<id>\d+)', 'documents/destroy');

$router->get('','', 'pages/index.php');

// api/document/new/invrpt?isEditMode=true
// api/document/1248923?isEditMode=true
//$router->get('api/document/(?<id>\d+)', 'api/document-id.php');
//$router->get('api/document/new/(?<type>\w{6})', 'api/document-type.php');

// User
//$router->add('register', 'users/register.php', ['get', 'post'])->only('guest');
//$router->post('register', 'users/store.php')->only('guest');
//$router->add('login', 'users/login.php', ['get', 'post'])->only('guest');
//$router->get('logout', 'users/logout.php')->only('auth');
//$router->get('user', 'users/index.php')->only('auth');
