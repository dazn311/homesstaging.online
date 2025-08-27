<?php

use Utils\{App, Db};

$title = 'Главная :: HomeStaging';

$db = App::get(Db::class);


$menu = $db->query("
        SELECT B.breadcrumbs_id, D.project_key, A.street, B.project_title, A.apartment  FROM document D
            LEFT JOIN breadcrumbs B     
                ON D.id = B.document_id 
            LEFT JOIN addressBook A
                ON D.id = A.document_id 
                WHERE D.mode = 'end'            
                ORDER BY D.createDate DESC ;",[]);
$menuArr = $menu->findAll();

$menu2Arr = [];
foreach ($menuArr as $menu) {
    $menu2Arr[$menu['project_title']][] = $menu;
}

if (isset($_REQUEST['details'])) {
    $project_key = $_REQUEST['details'];

    $documents = $db->query("
        SELECT D.id as id, title,category,street,apartment,price,end_date,project_title,project_url,project_des FROM document D 
            LEFT JOIN addressBook
                ON D.id = addressBook.document_id 
            LEFT JOIN description
                ON D.id = description.document_id 
            LEFT JOIN breadcrumbs
                ON D.id = breadcrumbs.document_id 
                WHERE D.project_key = ?;",[$project_key]);
    $res = $documents->find();

    $works = $db->query("
        SELECT * FROM document D
            LEFT JOIN worksPerformed W
                ON D.id = W.document_id 
                WHERE D.project_key = ? AND W.title_work IS NOT NULL 
                ORDER BY W.id ;",[$project_key]);
    $worksArr = $works->findAll();

    $images = $db->query("
        SELECT image_url AS imageUrl FROM image
                WHERE image.document_id = ?
                ORDER BY image.image_id
                LIMIT 10;",[$res['id']]);
    $imagesArr = $images->findAll();


//var_dump($res);
//var_dump($imagesArr);
var_dump($worksArr);
    $title = "{$res['project_title']} :: HomeStaging";

    require_once VIEWS . '/pages/details.tpl.php';
    die();
}

require_once VIEWS . '/pages/index.tpl.php';
