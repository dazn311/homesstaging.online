<?php
/**
doc_control_save_project;
 */

use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$fill_able = [
    'type','mode', 'street', 'apartment','fileName'
    ];

$worksPerformed = [];

$data = load($fill_able, true);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store :: HomeStaging';

$validator = new Validator();

if (isset($_FILES['fileName']) && $_FILES['fileName']['error'] === 0) {
    $data['fileName'] = $_FILES['fileName']['name'];
    $data['docFile'] = $_FILES['fileName'];
} else {
    $data['docFile'] = null;
}

$validation = $validator->validate($data, RULES_PROJECT);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];
    $request = [$data['type'], $data['mode'], $data['fileName'],$id_doc];
    $res = $db->query("UPDATE document SET `type` = ?, `mode_id` = ?,`fileName` = ? WHERE `id` = ?", $request);
    //запись адресов;
    $request = [$data['street'], $data['apartment'], $id_doc];
    $db->query("UPDATE addressBook SET `street` = ?, `apartment` = ? WHERE `document_id` = ?", $request);

     if ($res) {
         if (!empty($data['docFile']['name'])) {
             $id = $db->getInsertId();
             $file_ext = get_file_ext($data['docFile']['name']);
             $dir = '/' . 'doc_project';// HoffSup;

             if (!is_dir('TC_DATA' . $dir)) {
                 mkdir('TC_DATA' . $dir, 0755, true);
             }
             $filePath = 'TC_DATA' . "{$dir}/{$data['fileName']}.{$file_ext}";
             if (move_uploaded_file($data['docFile']['tmp_name'], $filePath)) {
                 $_SESSION['filePath'] = $filePath;
//                 $db->query("UPDATE documents SET `fileName` = ? WHERE `id` = ?", [$data['fileName'],$id]);
             } else {
                 error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
             }
         }
         $_SESSION['success'] = 'OK';
     } else {
         $_SESSION['error'] =  $_SESSION['error'] ?? '[97 doc_control_save_project] DB Error';
     }

} else {
    $_SESSION['error'] =  $_SESSION['error'] ?? '[101 doc_control_save_project] DB Error';
}


