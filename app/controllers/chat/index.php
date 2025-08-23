<?php


use Utils\{App, Db};

$title = 'Cislink :: Home';

$db = App::get(Db::class);

$users = $db->query("SELECT `name` FROM users;");

if ($users) {
    $users = $users->findAll();
}
if (!$users) {
    $users = [];
}
//dd($users);
$title = "Чат :: Cislink";

if (isset($_SESSION['user'])) {
    require_once VIEWS . '/chat/index.tpl.php';
} else {
    require_once VIEWS . '/chat/index.tpl.php';
}
