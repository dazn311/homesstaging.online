<?php

if (!check_auth()) {
    redirect('/');
}

use Utils\{App, Db};

$db = App::get(Db::class);

$users = $db->query("SELECT `name` FROM user;");

if ($users) {
    $users = $users->findAll();
}
if (!$users) {
    $users = [];
}
//dd($users);
$title = "Добавить документ :: HomeStaging";
require_once VIEWS . '/documents/create.tpl.php';
