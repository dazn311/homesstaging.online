<?php

use Utils\{App, Db};

$title = 'Объект :: doc_show';

$db = App::get(Db::class);

$idDoc = route_param('documents','all');// '1248303'


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

    if ($document) {
        $title = "doc_show {$document['project_key']} => show.tpl";
    } else {
        require_once VIEWS . '/errors/404.tpl.php';
        die();
    }

    $description = $db->query("
        SELECT W.title, W.category, W.price, W.project_url, W.project_des, DATE_FORMAT(W.end_date, '%d.%m.%Y') AS end_date FROM document D
            LEFT JOIN description W
                ON D.id = W.document_id 
                WHERE D.id = ?;",[$idDoc]);
    $descriptionArr = $description->find();

    $works = $db->query("
        SELECT W.title_work FROM document D
            LEFT JOIN worksPerformed W
                ON D.id = W.document_id 
                WHERE D.id = ? AND W.title_work IS NOT NULL 
                ORDER BY W.id ;",[$idDoc]);
    $worksArr = $works->findAll();
} else {
    require_once VIEWS . '/errors/404.tpl.php';
    die();
}

require_once VIEWS . '/documents/show.tpl.php';
