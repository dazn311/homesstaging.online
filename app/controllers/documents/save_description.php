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

$title = 'doc_store=>save.tpl';

$validator = new Validator();

$validation = $validator->validate($data, [
    'title' => [
        'required' => true,
        'min' => 1,
        'max' => 20,
    ],
    'category' => [
        'required' => true,
        'min' => 1,
        'max' => 50,
    ],
    'price' => [
        'required' => true,
        'min' => 1,
        'max' => 10,
    ],
    'project_url' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ],
    'project_des' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ]
]);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];

    $isHasTab = $db->query("SELECT COUNT(id) AS lengthId FROM description WHERE document_id = ?",[$idDoc]);
    $isHasTab = $isHasTab->find();

    if ($isHasTab['lengthId'] > 0) {
        $db->query("UPDATE description
        SET title = ?, category = ?, price = ?, project_url = ?, project_des = ?, end_date = ?, document_id = ?
        WHERE document_id = ?;",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$data['end_date'],$idDoc, $idDoc]);
    } else {
        $db->query("
            INSERT INTO description (title, category, price, project_url, project_des, end_date, document_id) 
            VALUES (?,?,?,?,?,?,?);",[$data['title'],$data['category'],$data['price'],$data['project_url'],$data['project_des'],$data['end_date'],$idDoc]);
    }
}
