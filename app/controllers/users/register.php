<?php

use Utils\{App, Db, Validator};

$title = "Home Staging :: Register";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /** @var Db $db */
    $db = App::get(Db::class);
    $data = load(['name', 'email', 'password']);

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $data['avatar'] = $_FILES['avatar'];
    } else {
        $data['avatar'] = null;
    }

    $validator = new Validator();

    $validation = $validator->validate($data, [
        'name' => [
            'required' => true,
            'max' => 100,
        ],
        'email' => [
            'email' => true,
            'max' => 100,
            'unique' => 'users:email'
        ],
        'password' => [
            'required' => true,
            'min' => 6,
        ],
        'avatar' => [
            // 'required' => true,
            // 'ext' => 'jpg|jpeg|png',
            'size' => 1_048_576,
        ],
    ]);

    if (!$validation->hasErrors()) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        if ($db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (?,?,?)", [$data['name'],$data['email'],$data['password']])) {
          
          if (!empty($data['avatar']['name'])) {
            $id = $db->getInsertId();
            $file_ext = get_file_ext($data['avatar']['name']);
            $dir = '/avatars/' . date('Y') . '/' . date('m') . '/' . date('d');
            if (!is_dir(UPLOADS . $dir)) {
              mkdir(UPLOADS . $dir, 0777, true);
            }
            $filePath = UPLOADS . "{$dir}/avatar-{$id}.{$file_ext}";
            $fileUrl = "/uploads{$dir}/avatar-{$id}.{$file_ext}";
            if (move_uploaded_file($data['avatar']['tmp_name'], $filePath)) {
              $db->query("UPDATE users SET avatar = ? WHERE id = ?", [$fileUrl,$id]);
            } else {
              error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
            }
          }
          
          $_SESSION['success'] = 'Вы успешно зарегистрировались';
          redirect(PATH);
        } else {
            $_SESSION['error'] = 'DB Error';
        }
    }
}

require_once VIEWS . '/users/register.tpl.php';
