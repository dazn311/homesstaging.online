<?php

use Utils\{App, Db};

$title = 'Главная :: Cislink';

$db = App::get(Db::class);

$documents = $db->query("
SELECT * FROM documents 
    LEFT JOIN users 
        ON documents.userId = users.id 
         WHERE documents.mode = 'edit' OR documents.mode = 'read';");

if ($documents) {
    $documents = $documents->findAll();
    if (!$documents) {
        $documents = [];
    }
} else {
    $documents = [];
}


$posts[] = [
    'id'=> 1,
    'title'=> 'title 1',
    'excerpt'=> 'excerpt 1',
];

$posts[] = [
    'id'=> 2,
    'title'=> 'title 2',
    'excerpt'=> 'excerpt 2',
];

$recent_posts[] = [
    'id'=> 2,
    'title'=> 'title 2',
];

require_once VIEWS . '/documents/index.tpl.php';

/**
 * $documents = $db->query("
 * SELECT
 * documents.fileName,
 * documents.type,
 * documents.idDoc,
 * Customers.CustomerName,
 * users.name,
 * users.avatar
 * FROM
 * documents
 * INNER JOIN
 * users ON documents.userId = users.id
 * WHERE
 * documents.type = 'invrpt'
 * AND documents.mode > 'edit';");
 */