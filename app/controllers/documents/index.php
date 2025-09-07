<?php
/*
 * control-doc-index;
 * route /?documents=all
 * */
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

if (isset($_SESSION['lastDocId'])) {
    $lastDocId = (int) $_SESSION['lastDocId'];
    foreach ($documents as $documentObject) {
        if ($documentObject['doc_id'] == $lastDocId) {
            $recent_posts[] = $documentObject;
        }
    }
} else {
    $recent_posts[] = [
        'doc_id'=> 2,
        'project_key'=> 'mitino1',
        'project_title'=> 'ЖК Митинский лес',
        'street'=> 'ул. Муравская',
        'apartment'=> '38Бк1',
    ];
}

require_once VIEWS . '/documents/index.tpl.php';
