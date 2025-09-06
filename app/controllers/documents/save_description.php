<?php
/**
for save description;
 */

//if (!check_auth()) {
//    redirect('/');
//}

use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$fill_able = ['title','category','price','project_url','project_des','end_date'];


$data = load($fill_able, true);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store :: HomeStaging';

$validator = new Validator();

//require CONFIG . '/rules.php';
$validation = $validator->validate($data, RULES_DESCRIPTION);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];

    $isHasTab = $db->query("SELECT COUNT(id) AS lengthId FROM description WHERE document_id = ?",[$idDoc]);
    $isHasTab = $isHasTab->find();

    if ($isHasTab['lengthId'] > 0) {
        $res = $db->query("UPDATE description
        SET title = ?, category = ?, price = ?, project_url = ?, project_des = ?, end_date = ?, document_id = ?
        WHERE document_id = ?;",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$data['end_date'],$idDoc, $idDoc]);

        if ($res) {
            $_SESSION['success'] = 'данные успешно обновлены.';
        }
    } else {
        $res = $db->query("
            INSERT INTO description (title, category, price, project_url, project_des, end_date, document_id) 
            VALUES (?,?,?,?,?,?,?);",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$data['end_date'],$idDoc]);
        if ($res) {
            $_SESSION['success'] = 'данные успешно созданы и записаны.';
        }
    }
} else {
    $_SESSION['error'] = 'Одно или несколько полей не прошли валидацию.';
}
