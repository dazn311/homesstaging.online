<?php

if (isset($_SESSION['user'])) {
    require_once VIEWS . '/users/index.tpl.php';
}

