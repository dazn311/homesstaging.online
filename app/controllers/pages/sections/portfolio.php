<?php

use Utils\{App, Db};

$db = App::get(Db::class);


$images = $db->query("
        SELECT  I.image_id AS imageId, I.image_url AS imageUrl, 
                D.project_key AS projectKey, 
                B.project_title AS projectTitle FROM image I
            LEFT JOIN breadcrumbs B
                ON I.document_id = B.document_id
            LEFT JOIN document D     
                ON D.id = I.document_id
            WHERE D.mode_id = 3
            ORDER BY D.createDate DESC ;",[]);

if ($images) {
    $images = $images->findAll();
} else {
    $images = [];
}

$Portfolio2Arr = [];
foreach ($images as $image) {
    if (isset($Portfolio2Arr[$image['projectKey']])) {
        if (count($Portfolio2Arr[$image['projectKey']]) < 3) {
            $Portfolio2Arr[$image['projectKey']][] = $image;
        }
    } else {
        $Portfolio2Arr[$image['projectKey']][] = $image;
    }
}
//var_dump($images);
//var_dump($Portfolio2Arr);
require VIEWS . '/pages/sections/portfolio.tpl.php';
