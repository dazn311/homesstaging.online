<?php
/**
for create document;
 */
//if (!check_auth()) {
//    redirect('/');
//}
use Utils\{App, Db};

$db = App::get(Db::class);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store=>edit.tpl';

$data = load(['_action'], true);

if ($data['_action'] == 'save') {
    require_once CONTROLLERS . '/documents/save.php';
}

$querySt = "
    SELECT D.id AS doc_id, D.project_key, D.createDate, D.mode_id AS mode, D.type, D.fileName,
               A.street, A.apartment,
               U.avatar, U.name
    FROM document D
        LEFT JOIN addressBook A
            ON D.id = A.document_id
        LEFT JOIN mode M
            ON M.id = D.mode_id
        LEFT JOIN user U
            ON D.userRole = U.role
            WHERE D.id = ?;";

$document = $db->query($querySt,[$idDoc]);
$descriptionArr = [];
$worksArr = [];
$statusModeArr = [];
$captionsArr = [];

if ($document) {
    $document = $document->find();

    if (!$document) {
        require_once VIEWS . '/errors/404.tpl.php';
        die();
    } else {
        $title = "doc_store {$document['project_key']} :: edit.tpl";
    }
    $description = $db->query("
        SELECT W.title, W.category, W.price, W.project_url, W.project_des, DATE_FORMAT( W.end_date, '%Y-%m-%d') AS end_date FROM document D
            LEFT JOIN description W
                ON D.id = W.document_id 
                WHERE D.id = ?;",[$idDoc]);
    $descriptionArr = $description->find();

    $works = $db->query("
        SELECT * FROM document D
            LEFT JOIN worksPerformed W
                ON D.id = W.document_id 
                WHERE D.id = ? AND W.title_work IS NOT NULL 
                ORDER BY W.id ;",[$idDoc]);
    $worksArr = $works->findAll();
    if (count($worksArr) == 0) {
        $worksArr = array(
            0=> ["title_work" => ""],
            1=> ["title_work" => ""],
            3=> ["title_work" => ""],
            4=> ["title_work" => ""],
            5=> ["title_work" => ""]
        );
    }

    $status_mode = $db->query("SELECT id, title_mode FROM mode;",[]);
    $statusMode = $status_mode->findAll();
    $statusModeArr = [];
    if (is_array($statusMode)) {
        foreach ($statusMode as $mode) {
            $statusModeArr[$mode['id']] = $mode['title_mode'];
        }
    }

    $captions = $db->query("SELECT caption_key, input_type, caption_ru FROM caption;",[]);
    $captions = $captions->findAll();

    if (is_array($captions)) {
        foreach ($captions as $caption) {
            $captionsArr[$caption['caption_key']] = $caption;
        }
    }

} else {
    $document = [];
}
//var_dump($document);
require_once VIEWS . '/documents/edit.tpl.php';
