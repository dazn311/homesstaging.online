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
require_once VIEWS . '/pages/index.tpl.php';
