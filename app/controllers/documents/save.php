<?php
/**
for save document;
 */

//if (!check_auth()) {
//    redirect('/');
//}

use Utils\{App, Db, Validator};

$db = App::get(Db::class);

$fill_able = [
    'type','mode', 'street', 'apartment','fileName',
    'title','category','price','project_url','project_des','end_date'
    ];

$worksPerformed = [];

$data = load($fill_able, true);
$worksPerformed_data= loadOfKeys('worksPerformed_', true);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store=>save.tpl';

$validator = new Validator();

$validation = $validator->validate($data, [
    'type' => [
        'required' => true,
        'min' => 3,
        'max' => 30,
    ],
    'mode' => [
        'required' => true,
        'min' => 3,
        'max' => 4,
    ],
    'street' => [
        'required' => true,
        'min' => 6,
        'max' => 50,
    ],
    'apartment' => [
        'required' => true,
        'min' => 3,
        'max' => 100,
    ],
    'fileName' => [
//        'required' => true,
        // 'ext' => 'jpg|jpeg|png',
//        'size' => 1_048_576,
    ],
]);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];
    $request = [$data['type'], $data['mode'], $data['fileName'],$id_doc];
    $db->query("UPDATE document SET `type` = ?, `mode` = ?,`fileName` = ? WHERE `id` = ?", $request);
    //запись адресов;
    $request = [$data['street'], $data['apartment'], $id_doc];
    $db->query("UPDATE addressBook SET `street` = ?, `apartment` = ? WHERE `document_id` = ?", $request);
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
        $db->query("INSERT INTO worksPerformed (title_work, document_id) VALUES {$valueStr};", $paramsArr);
    }

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



//$fillable = ['fileName','idDoc', 'typeDoc', 'userName','readMode', 'isNewDoc'];
//$data = load($fillable, true);
//var_dump($_POST['_method']);// POST
//var_dump($_POST['id']);//2

//var_dump($_POST);
//'type' => string 'Евродвушка' (length=20)
//'mode' => string 'end' (length=3)
//'street' => string 'ул. Муравская' (length=24)
//'apartment' => string '38Бк1' (length=7)
//'fileName' => string 'mitino1-Nata-250807.xlsx' (length=24)
//'worksPerformed_0' => string 'красили стены, устанавливали панели;' (length=67)
//'worksPerformed_1' => string 'меняли двери, в т.ч. входную, регулировали окна и меняли откосы;' (length=114)
//'worksPerformed_2' => string 'в ванной меняли унитаз, красили швы, меняли душевую стойку и раковину;' (length=127)
//'worksPerformed_3' => string 'бытовая техника Weissgauff, фартук на кухне демонтировали и сделали из керамогранита;' (length=148)
//'worksPerformed_4' => string 'Установка сплит системы.' (length=45)
//'_method' => string 'POST' (length=4)
//'id' => string '2' (length=1)
//var_dump($idDoc);//3


//var_dump($worksPerformed_data);
//array (size=5)
//0 => string 'красили стены, устанавливали панели;' (length=67)
//1 => string 'меняли двери, в т.ч. входную, регулировали окна и меняли откосы;' (length=114)
//2 => string 'в ванной меняли унитаз, красили швы, меняли душевую стойку и раковину;' (length=127)
//3 => string 'бытовая техника Weissgauff, фартук на кухне демонтировали и сделали из керамогранита;' (length=148)
//4 => string 'Установка сплит системы.' (length=45)








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

