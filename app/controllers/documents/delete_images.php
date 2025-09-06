<?php
/**
for delete image;
 */

use Utils\{App, Db};

$db = App::get(Db::class);

$fill_able = ['image_id'];

$data = load($fill_able, true);

$title = 'doc_store :: HomeStaging';

//запись документа;
$image_id = $data['image_id'];
$querySt = "SELECT * FROM image WHERE image_id = ?;";

$image = $db->query($querySt,[$image_id]);
$image = $image->find();

if (isset($image['image_id'])) {
    $queryImageSt = "DELETE FROM image WHERE image_id = ?;";
    $image_deleted = $db->query($queryImageSt,[$image['image_id']]);
    $image_deleted = $image_deleted->find();

    $fileToDelete = WWW . '/' . $image['image_url']; //   /uploads/mitino2/32к1/20250904_17_34_45.jpeg

    if (unlink($fileToDelete)) {
        $_SESSION['success'] = "Файл '{$fileToDelete}' был успешно удален.";
        unset($_SESSION['error']);
    } else {
        $_SESSION['error'] = "Error: Could not delete file '{$fileToDelete}'.";
        unset($_SESSION['success']);
    }
} else {
    unset($_SESSION['success']);
    $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
}


