<?php


use Utils\{App, Db};

$title = 'Home :: HomeStaging';

$db = App::get(Db::class);

$users = $db->query("SELECT `name` FROM user;");

if ($users) {
    $users = $users->findAll();
}
if (!$users) {
    $users = [];
}
//dd($users);
$title = "Чат :: HomeStaging";

if (isset($_SESSION['user'])) {
    require_once VIEWS . '/chat/index.tpl.php';
} else {
    require_once VIEWS . '/chat/index.tpl.php';
}
