<?php

use Utils\{App, Db};

$title = 'Объект :: HomeStaging';

$db = App::get(Db::class);

$idDoc = route_param('document_id','1248303');// '1248303'


$document = $db->query("
    SELECT D.id AS doc_id, D.project_key, D.createDate, D.mode, D.type, D.fileName,
               A.street, A.apartment,
               U.avatar, U.name
    FROM document D
        LEFT JOIN addressBook A
            ON D.id = A.document_id
        LEFT JOIN user U
            ON D.userRole = U.role
            WHERE D.id = ?;",[$idDoc]);



if ($document) {
    $document = $document->find();
//    var_dump($idDoc);
    if (!$document) {
        $document = [];
    } else {
//        var_dump($document['project_key']);
        $title = "{$document['project_key']} :: HomeStaging";
    }
    $works = $db->query("
        SELECT * FROM document D
            LEFT JOIN worksPerformed W
                ON D.id = W.document_id 
                WHERE D.id = ? AND W.title_work IS NOT NULL 
                ORDER BY W.id ;",[$idDoc]);
    $worksArr = $works->findAll();
//    var_dump($worksArr);
} else {
    $document = [];
}

require_once VIEWS . '/documents/show.tpl.php';
