<?php
/**
for create document;
 */
require CONFIG . '/rules.php';
//if (!check_auth()) {
//    redirect('/');
//}
use Utils\{App, Db};

$db = App::get(Db::class);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store_control :: HomeStaging';

$data = load(['_action'], true);
//var_dump($data);
switch ($data['_action']) {
    case 'save_project':
        $_SESSION['activeTab'] = 'general';
        require_once CONTROLLERS . '/documents/save_project.php';
        break;
    case 'save_description':
        $_SESSION['activeTab'] = 'description';
        require_once CONTROLLERS . '/documents/save_description.php';
        break;
    case 'save_works':
        $_SESSION['activeTab'] = 'works';
        require_once CONTROLLERS . '/documents/save_works.php';
        break;
    case 'save_images':
        $_SESSION['activeTab'] = 'photo';
        require_once CONTROLLERS . '/documents/save_images.php';
        break;
    case 'delete_images':
        $_SESSION['activeTab'] = 'photo';
        require_once CONTROLLERS . '/documents/delete_images.php';
        break;
    default:
        $_SESSION['activeTab'] = 'general';
        break;
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
$imagesArr = [];

if ($document) {
    $document = $document->find();

    if (!$document) {
        require_once VIEWS . '/errors/404.tpl.php';
        die();
    } else {
        $title = "doc_store {$document['project_key']} :: HomeStaging";
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
    if (count($worksArr) < 5) {
        $worksArr2 = array(
            0=> ["title_work" => ""],
            1=> ["title_work" => ""],
            3=> ["title_work" => ""],
            4=> ["title_work" => ""],
            5=> ["title_work" => ""]
        );
        $mergedArray = array_merge($worksArr, $worksArr2);
        $worksArr = array_slice($mergedArray,0,5);
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
    $images = $db->query("SELECT image_id, image_url, image_description FROM image WHERE document_id = ?;",[$idDoc]);
    $imagesArr = $images->findAll();

} else {
    $document = [];
}

require_once VIEWS . '/documents/edit.tpl.php';
