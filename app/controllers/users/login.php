<?php

use Utils\{App, Db, Validator};

$title = "Login :: HomeStaging";

$data = load(['email', 'password']);

$validator = new Validator();

$_SESSION['oldData'] = $data;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /** @var Db $db */
    $db = App::get(Db::class);

    $validation = $validator->validate($data, [
        'email' => [
            'required' => true,
        ],
        'password' => [
            'required' => true,
        ],
    ]);

    if (!$validation->hasErrors()) {
        if (!$user = $db->query("SELECT * FROM user WHERE email = ?", [$data['email']])->find()) {
            $_SESSION['error'] = 'Ошибка: не верный логин или пароль ' . $data['email'] . ', ' . $data['password'];
            redirect('/?login=user');
        }

        if (!password_verify($data['password'], $user['password'])) {
            $_SESSION['error'] = 'Ошибка: не верный логин или пароль ' . $data['email'] . ', ' . $data['password'];
            redirect('/?login=user');
        }
        $_SESSION['user'] = [];
        foreach ($user as $key => $value) {
            if ($key != 'password') {
                $_SESSION['user'][$key] = $value;
            }
        }

        $_SESSION['success'] = 'Successful login';
        redirect('/?documents=all');
    }
}

require_once VIEWS . '/users/login.tpl.php';
