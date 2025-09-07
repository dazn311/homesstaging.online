<?php
/*
 * control-page-show;
 * route /?documents=all
 * */
use Utils\{App, Db};

$title = 'Home :: HomeStaging';

$db = App::get(Db::class);
$idDoc = route_param('id','1248303');// '1248303'

$document = $db->query("
    SELECT * FROM documents 
    LEFT JOIN user
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
