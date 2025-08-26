<?php

use \Utils\{App, ServiceContainer, Db};

$container = new ServiceContainer();
$container->setService(Db::class, function () {
    $db_config = require CONFIG . '/db.php';
    return (Db::getInstance())->getConnection($db_config);
});

App::setContainer($container);
