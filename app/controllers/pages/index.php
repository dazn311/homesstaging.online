<?php

$title = 'Главная :: Cislink';
//dd($_REQUEST);
if (isset($_REQUEST['details'])) {
    $details = $_REQUEST['details'];
//    if ($details == 'mitino1') {
//        dd($details);
//    }
    require_once VIEWS . '/pages/details.tpl.php';
    die();
}
require_once VIEWS . '/pages/index.tpl.php';
