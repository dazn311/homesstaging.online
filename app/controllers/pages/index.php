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

switch (true) {
    case isset($_REQUEST['details']):
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

        $title = "{$res['project_title']} :: HomeStaging";

        require_once VIEWS . '/pages/details.tpl.php';
        die();
    case isset($_REQUEST['documents']):
        require_once CONTROLLERS . '/documents/index.php';
        die();
    case isset($_REQUEST['document']):
        $document_id = $_REQUEST['document'];
        if (preg_match("#^\d+#", $document_id, $matches)) {
            require_once CONTROLLERS . '/documents/show.php';
            die();
        }
        require_once CONTROLLERS . '/documents/index.php';
        die();
        default:
            require_once VIEWS . '/pages/index.tpl.php';
}

//$router->get('documents', 'documents/index.php');
//$router->get('document/(?<id>\d+)', 'documents/show.php');
//$router->get('documents/create', 'documents/create.php')->only('auth');
//$router->post('documents', 'documents/store.php');
//$router->delete('documents', 'documents/destroy.php');

//http://localhost:8088/?document=4
//var_dump($_REQUEST);
//array (size=4)
//  'document' => string '4' (length=1)
//  'PHPSESSID' => string 'SSO-595215b5cb2d3789ef33f836abd512fc' (length=36)
//  'AuthSSO' => string '00777' (length=5)
//  'daz' => string 'forLocal' (length=8)

//http://localhost:8088/?documents=all
//var_dump($_REQUEST);
//array (size=4)
//  'documents' => string 'all' (length=3)
//  'PHPSESSID' => string 'SSO-595215b5cb2d3789ef33f836abd512fc' (length=36)
//  'AuthSSO' => string '00777' (length=5)
//  'daz' => string 'forLocal' (length=8)