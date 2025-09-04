<?php
/**
for delete image;
 */

use Utils\{App, Db};

$db = App::get(Db::class);

$fill_able = ['image_id'];

$data = load($fill_able, true);

$title = 'doc_store=>edit.tpl';

//запись документа;
$image_id = $data['image_id'];
$querySt = "SELECT * FROM image WHERE image_id = ?;";

$image = $db->query($querySt,[$image_id]);
$image = $image->find();

if (isset($image['image_id'])) {
    $queryImageSt = "DELETE FROM image WHERE image_id = ?;";
    $image = $db->query($queryImageSt,[$image['image_id']]);
    $_SESSION['success'] = 'OK';
    $_SESSION['error'] =  '';
} else {
    $_SESSION['success'] = '';
    $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
}


