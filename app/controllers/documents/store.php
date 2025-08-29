<?php
/**
for create document;
 */
//if (!check_auth()) {
//    redirect('/');
//}
use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$idDoc = route_param('documents','all');// '1248303'

$title = 'Редактирование объекта :: HomeStaging';

//$fillable = ['fileName','idDoc', 'typeDoc', 'userName','readMode', 'isNewDoc'];
//$data = load($fillable, true);
//var_dump($_POST['_method']);// POST
//var_dump($_POST['id']);//3
//var_dump($idDoc);//3

$querySt = "
    SELECT D.id AS doc_id, D.project_key, D.createDate, D.mode, D.type, D.fileName,
               A.street, A.apartment,
               U.avatar, U.name
    FROM document D
        LEFT JOIN addressBook A
            ON D.id = A.document_id
        LEFT JOIN user U
            ON D.userRole = U.role
            WHERE D.id = ?;";

$document = $db->query($querySt,[$idDoc]);

if ($document) {
    $document = $document->find();

    if (!$document) {
        require_once VIEWS . '/errors/404.tpl.php';
        die();
    } else {
        $title = "Редактирование {$document['project_key']} :: HomeStaging";
    }

    $works = $db->query("
        SELECT * FROM document D
            LEFT JOIN worksPerformed W
                ON D.id = W.document_id 
                WHERE D.id = ? AND W.title_work IS NOT NULL 
                ORDER BY W.id ;",[$idDoc]);
    $worksArr = $works->findAll();
} else {
    $document = [];
}

require_once VIEWS . '/documents/edit.tpl.php';














//if (isset($_FILES['docFile']) && $_FILES['docFile']['error'] === 0) {
//    $data['docFile'] = $_FILES['docFile'];
//} else {
//    $data['docFile'] = null;
//}

//if (isset($data['readMode'])) {
//    $data['mode'] = $data['readMode'] === 'on' ? 'edit' : 'read';
//} else {
//    $data['mode'] = 'read';
//}

//$validator = new Validator();

//$validation = $validator->validate($data, [
//    'fileName' => [
//        'required' => true,
//        'min' => 5,
//        'max' => 100,
//    ],
//    'idDoc' => [
//        'required' => true,
//        'min' => 3,
//        'max' => 10,
//    ],
//    'typeDoc' => [
//        'required' => true,
//        'min' => 6,
//        'max' => 10,
//    ],
//    'userName' => [
//        'required' => true,
//        'min' => 3,
//        'max' => 100,
//    ],
//    'docFile' => [
//        'required' => true,
//        // 'ext' => 'jpg|jpeg|png',
//        'size' => 1_048_576,
//    ],
//]);

//if (!$validation->hasErrors()) {
//    $userId = $db->query("SELECT `id` FROM user WHERE user.name = ?;", [$data['userName']])->find();
//    $data['userId'] =  $userId['id'] ?? 0;
//    $data['userId'] =  (string) $data['userId'];
//    $request = [$data['typeDoc'], $data['idDoc'], $data['mode'],date("Y-m-d H:i:s"), $data['userId'], $data['fileName'] . 'json'];
//    $res = $db->query("INSERT INTO document (`type`, `idDoc`, `mode`,`createDate`,`userId`,`fileName`) VALUES (?,?,?,?,?,?)", $request);
//
//     if ($data['userId'] && $res) {
//         if (!empty($data['docFile']['name'])) {
//             $id = $db->getInsertId();
//             $file_ext = get_file_ext($data['docFile']['name']);
//             $dir = '/' . $data['userName'];// HoffSup;
//
//             if (!is_dir('TC_DATA' . $dir)) {
//                 mkdir('TC_DATA' . $dir, 0755, true);
//             }
//             $filePath = 'TC_DATA' . "{$dir}/{$data['fileName']}.{$file_ext}";
//             if (move_uploaded_file($data['docFile']['tmp_name'], $filePath)) {
//                 $_SESSION['filePath'] = $filePath;
////                 $db->query("UPDATE documents SET `fileName` = ? WHERE `id` = ?", [$data['fileName'],$id]);
//             } else {
//                 error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
//             }
//         }
//         $_SESSION['success'] = 'OK';
//     } else {
//         $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
//     }
//    redirect('/');
//} else {
//    redirect('/documents/create');
//}

