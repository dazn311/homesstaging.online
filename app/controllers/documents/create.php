<?php

if (!check_auth()) {
    redirect('/');
}

use Utils\{App, Db};

$db = App::get(Db::class);

$users = $db->query("SELECT `name` FROM users;");

if ($users) {
    $users = $users->findAll();
}
if (!$users) {
    $users = [];
}
//dd($users);
$title = "Добавить документ :: Home Staging";
require_once VIEWS . '/documents/create.tpl.php';
