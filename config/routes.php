<?php

use Utils\middleware\{Auth, Guest};

/** @var $router */

const MIDDLEWARE = [
    'auth' => Auth::class,
    'guest' => Guest::class,
];

///uploads/avatars/2025/08/11/avatar-5.png
$router->get('uploads/avatars/\d+/\d+/\d+/avatar-\d+.png', 'api/uploads.php');
//chat;
$router->get('chat', 'chat/index.php');

//pages
$router->get('', 'pages/index.php');

//documents
//$router->get('documents', 'documents/index.php');
//$router->get('document/(?<id>\d+)', 'documents/show.php');
//$router->get('documents/create', 'documents/create.php')->only('auth');
//$router->post('documents', 'documents/store.php');
//$router->delete('documents', 'documents/destroy.php');

// Pages
$router->get('about', 'about.php');
$router->get('contact', 'contact.php');

// api cislink;
// api/user/info
$router->get('api/user/info', 'api/user-info.php');

//api list;
$router->get('api/filters/(?<type>\w{6})', 'api/no-find-route.php');
$router->get('api/(?<type>\w{6})/list', 'api/no-find-route.php');

// api/document/new/invrpt?isEditMode=true
// api/document/1248923?isEditMode=true
//$router->get('api/document/(?<id>\d+)', 'api/document-id.php');
//$router->get('api/document/new/(?<type>\w{6})', 'api/document-type.php');

// User
$router->add('register', 'users/register.php', ['get', 'post'])->only('guest');
//$router->post('register', 'users/store.php')->only('guest');
$router->add('login', 'users/login.php', ['get', 'post'])->only('guest');
$router->get('logout', 'users/logout.php')->only('auth');
$router->get('user', 'users/index.php')->only('auth');
