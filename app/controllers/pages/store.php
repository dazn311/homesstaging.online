<?php
/**
for create document;
 */
if (!check_auth()) {
    redirect('/');
}
use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$fillable = ['fileName','idDoc', 'typeDoc', 'userName','readMode', 'isNewDoc'];
$data = load($fillable, true);

if (isset($_FILES['docFile']) && $_FILES['docFile']['error'] === 0) {
    $data['docFile'] = $_FILES['docFile'];
} else {
    $data['docFile'] = null;
}

if (isset($data['readMode'])) {
    $data['mode'] = $data['readMode'] === 'on' ? 'edit' : 'read';
} else {
    $data['mode'] = 'read';
}

$validator = new Validator();

$validation = $validator->validate($data, [
    'fileName' => [
        'required' => true,
        'min' => 5,
        'max' => 100,
    ],
    'idDoc' => [
        'required' => true,
        'min' => 3,
        'max' => 10,
    ],
    'typeDoc' => [
        'required' => true,
        'min' => 6,
        'max' => 10,
    ],
    'userName' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ],
    'docFile' => [
        'required' => true,
        // 'ext' => 'jpg|jpeg|png',
        'size' => 1_048_576,
    ],
]);

if (!$validation->hasErrors()) {
    $userId = $db->query("SELECT `id` FROM users WHERE users.name = ?;", [$data['userName']])->find();
    $data['userId'] =  $userId['id'] ?? 0;
    $data['userId'] =  (string) $data['userId'];
    $request = [$data['typeDoc'], $data['idDoc'], $data['mode'],date("Y-m-d H:i:s"), $data['userId'], $data['fileName'] . 'json'];
    $res = $db->query("INSERT INTO documents (`type`, `idDoc`, `mode`,`createDate`,`userId`,`fileName`) VALUES (?,?,?,?,?,?)", $request);

     if ($data['userId'] && $res) {
         if (!empty($data['docFile']['name'])) {
             $id = $db->getInsertId();
             $file_ext = get_file_ext($data['docFile']['name']);
             $dir = '/' . $data['userName'];// HoffSup;

             if (!is_dir(TC_DATA . $dir)) {
                 mkdir(TC_DATA . $dir, 0755, true);
             }
             $filePath = TC_DATA . "{$dir}/{$data['fileName']}.{$file_ext}";
             if (move_uploaded_file($data['docFile']['tmp_name'], $filePath)) {
                 $_SESSION['filePath'] = $filePath;
//                 $db->query("UPDATE documents SET `fileName` = ? WHERE `id` = ?", [$data['fileName'],$id]);
             } else {
                 error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
             }
         }
         $_SESSION['success'] = 'OK';
     } else {
         $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
     }
    redirect('/');
} else {
    redirect('/documents/create');
//    require VIEWS . '/documents/create.tpl.php';
}

