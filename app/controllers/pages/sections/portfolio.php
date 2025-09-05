<?php

use Utils\{App, Db};

$db = App::get(Db::class);


$images = $db->query("
        SELECT  I.image_id AS imageId, I.image_url AS imageUrl, 
                D.project_key AS projectKey, 
                W.price AS price, 
                B.project_title AS projectTitle FROM image I
            LEFT JOIN breadcrumbs B
                ON I.document_id = B.document_id
            LEFT JOIN description W
                ON I.document_id = W.document_id
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

require VIEWS . '/pages/sections/portfolio.tpl.php';

//var_dump($Portfolio2Arr);
//'ilyinskie1' =>
//array (size=1)
//  0 =>
//    array (size=4)
//      'imageId' => int 28
//      'imageUrl' => string 'uploads/ilyinskie1/2/20250905_10_53_17.jpg' (length=42)
//      'projectKey' => string 'ilyinskie1' (length=10)
//      'projectTitle' => string 'ЖК Ильинские луга' (length=32)
//'mitino1' =>
//array (size=3)
//  0 =>
//    array (size=4)
//      'imageId' => int 1
//      'imageUrl' => string 'assets/img/flats/Mitinskii-les/38/2.png' (length=39)
//      'projectKey' => string 'mitino1' (length=7)
//      'projectTitle' => string 'ЖК Митинский лес' (length=30)
//  1 =>
//    array (size=4)
//      'imageId' => int 2
//      'imageUrl' => string 'assets/img/flats/Mitinskii-les/38/4.jpg' (length=39)
//      'projectKey' => string 'mitino1' (length=7)
//      'projectTitle' => string 'ЖК Митинский лес' (length=30)
//  2 =>
//    array (size=4)
//      'imageId' => int 3
//      'imageUrl' => string 'assets/img/flats/Mitinskii-les/38/5.jpg' (length=39)
//      'projectKey' => string 'mitino1' (length=7)
//      'projectTitle' => string 'ЖК Митинский лес' (length=30)
//'kronstadskii1' =>
//array (size=2)
//  0 =>
//    array (size=4)
//      'imageId' => int 29
//      'imageUrl' => string 'uploads/kronstadskii1/8к2/20250905_10_53_36.jpg' (length=48)
//      'projectKey' => string 'kronstadskii1' (length=13)
//      'projectTitle' => string 'ЖК Кронштадтский' (length=31)
//  1 =>
//    array (size=4)
//      'imageId' => int 30
//      'imageUrl' => string 'uploads/kronstadskii1/8к2/20250905_10_53_58.jpg' (length=48)
//      'projectKey' => string 'kronstadskii1' (length=13)
//      'projectTitle' => string 'ЖК Кронштадтский' (length=31)