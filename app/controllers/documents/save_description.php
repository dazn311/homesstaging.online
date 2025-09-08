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

$validator = new Validator();

$validation = $validator->validate($data, RULES_DESCRIPTION);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];

    $isHasTab = $db->query("SELECT COUNT(id) AS lengthId FROM description WHERE document_id = ?",[$idDoc]);
    $isHasTab = $isHasTab->find();
    $endDate = empty($data['end_date']) ? null : $data['end_date'];
    if ($isHasTab['lengthId'] > 0) {
        $res = $db->query("UPDATE description
        SET title = ?, category = ?, price = ?, project_url = ?, project_des = ?, end_date = ?, document_id = ?
        WHERE document_id = ?;",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$endDate,$idDoc, $idDoc]);

        if ($res) {
            $_SESSION['success'] = 'данные успешно обновлены.';
        }
    } else {
        $res = $db->query("
            INSERT INTO description (title, category, price, project_url, project_des, end_date, document_id) 
            VALUES (?,?,?,?,?,?,?);",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$endDate,$idDoc]);
        if ($res) {
            $_SESSION['success'] = 'данные успешно созданы и записаны.';
        } else {
            $_SESSION['error'] = 'данные не созданы и не записаны в бд.' . ' Номер документа: ' . $id_doc . ', DATE:' . $data['end_date'];
        }
    }
} else {
    $_SESSION['error'] = 'Одно или несколько полей не прошли валидацию.';
}
