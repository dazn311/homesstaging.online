<?php
/**
for save worksPerformed;
 */

use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$worksPerformed = [];

$worksPerformed_data= loadOfKeys('worksPerformed_', true);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store :: HomeStaging';

$validator = new Validator();


//запись документа;
$id_doc = $_POST['id'];

//удалить выполненные работы;
$db->query("DELETE FROM worksPerformed WHERE `document_id` = ?", [$id_doc]);
//добавить записи выполненные работы;
$insertValues = [];
if (is_array($worksPerformed_data)) {
    foreach ($worksPerformed_data as $work) {
        if (!empty($work)) {
            $insertValues[] = $work;
        }
    }
}

if (count($insertValues) > 0) {
    $valueArr = [];
    $paramsArr = [];

    foreach ($insertValues as $value) {
        $valueArr[] = "(?,?)";
        $paramsArr[] =  $value;
        $paramsArr[] =  $id_doc;
    }
    $valueStr = implode(',', $valueArr);
    $res = $db->query("INSERT INTO worksPerformed (title_work, document_id) VALUES {$valueStr};", $paramsArr);
    if ($res) {
        $_SESSION['success'] = 'данные успешно созданы и записаны.';
    } else {
        $_SESSION['error'] = 'данные не созданы и не записаны в бд.' . ' Номер документа: ' . $id_doc;
    }
}
