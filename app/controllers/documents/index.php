<?php

use Utils\{App, Db};

$title = 'Проекты :: HomeStaging';

$db = App::get(Db::class);

$menu = $db->query("
        SELECT D.id AS doc_id, D.project_key, D.createDate, M.title_mode AS mode, D.type, D.fileName,
               B.breadcrumbs_id, B.project_title, A.street, A.apartment  
        FROM document D
            LEFT JOIN breadcrumbs B     
                ON D.id = B.document_id
            LEFT JOIN mode M
                ON M.id = D.mode_id
            LEFT JOIN addressBook A
                ON D.id = A.document_id
                ORDER BY D.createDate DESC ;",[]);
$documents = [];
if ($menu) {
    $documents = $menu->findAll();
}


$recent_posts[] = [
    'id'=> 2,
    'title'=> 'ЖК Ильинские луга',
];

require_once VIEWS . '/documents/index.tpl.php';

/**
 * $documents = $db->query("
 * SELECT
 * documents.fileName,
 * documents.type,
 * documents.idDoc,
 * Customers.CustomerName,
 * users.name,
 * users.avatar
 * FROM
 * documents
 * INNER JOIN
 * users ON documents.userId = users.id
 * WHERE
 * documents.type = 'invrpt'
 * AND documents.mode > 'edit';");
 */