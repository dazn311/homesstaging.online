<?php

use Utils\{App, Db};

$title = 'Объект :: HomeStaging';

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
        $title = "{$document['project_key']} :: HomeStaging";
    } else {
        require_once VIEWS . '/errors/404.tpl.php';
        die();
    }

    $works = $db->query("
        SELECT * FROM document D
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
