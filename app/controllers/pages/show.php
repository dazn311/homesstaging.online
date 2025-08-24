<?php

use Utils\{App, Db};

$title = 'Cislink :: Home';

$db = App::get(Db::class);
$idDoc = route_param('id','1248303');// '1248303'

$document = $db->query("
    SELECT * FROM documents 
    LEFT JOIN users 
        ON documents.userId = users.id 
         WHERE documents.id = ?;",[$idDoc]);

if ($document) {
    $document = $document->find();
    if (!$document) {
        $document = [];
    }
} else {
    $document = [];
}

require_once VIEWS . '/documents/show.tpl.php';
