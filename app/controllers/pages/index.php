<?php

use Utils\{App, Db};

$title = 'Главная :: Home Staging';

$db = App::get(Db::class);

//dd($_REQUEST);
if (isset($_REQUEST['details'])) {
    $project_key = $_REQUEST['details'];

    $documents = $db->query("
        SELECT * FROM document 
            LEFT JOIN addressBook
                ON document.id = addressBook.document_id 
            LEFT JOIN description
                ON document.id = description.document_id 
            LEFT JOIN breadcrumbs
                ON document.id = breadcrumbs.document_id 
                WHERE document.project_key = ?;",[$project_key]);
    $res = $documents->find();

    $works = $db->query("
        SELECT * FROM document
            LEFT JOIN worksPerformed
                ON document.id = worksPerformed.document_id 
                WHERE document.project_key = ?
                ORDER BY worksPerformed.id ;",[$project_key]);
    $worksArr = $works->findAll();

    $images = $db->query("
        SELECT image_url AS imageUrl FROM image
                WHERE image.document_id = ?
                ORDER BY image.image_id
                LIMIT 10;",[$res['id']]);
    $imagesArr = $images->findAll();
//var_dump($imagesArr);
//var_dump($res);
    $title = "{$res['project_title']} :: HomeStaging";

    require_once VIEWS . '/pages/details.tpl.php';
    die();
}

$title = 'Главная :: Home Staging';

require_once VIEWS . '/pages/index.tpl.php';
