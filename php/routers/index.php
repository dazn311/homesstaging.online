<?php

use Utils\Router;

//require "./Router.php";
$request = htmlspecialchars(explode("?", $_SERVER['REQUEST_URI'])[0], ENT_QUOTES);
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//print_r($path);

$root_path = dirname(__DIR__);
$root_path2 = dirname($_SERVER['DOCUMENT_ROOT']);
$root_doc = $_SERVER['DOCUMENT_ROOT'];
$router = new Router();

$router->add("/", function() {
    global $root_path2;
    require "$root_path2/pages/main-page.php";
});

$router->add("/page", function() {
    echo "[15]router: new page";
});

$router->add("/user", function() {
    global $root_path2;
    require "$root_path2/pages/user-page.php";
});

$router->add("/php", function() {
    global $root_path2;
    require "$root_path2/php/index.php";
});

$router->add("/dashboard", function() {
    global $root_path2;
    require __DIR__ ."/../../pages/dashboard.php";
});

$router->add("/login", function() {
    global $root_path2;
    require "$root_path2/pages/login-page.php";
});

$router->add("/logout", function() {
    global $root_path2;
    require "$root_path2/pages/logout-page.php";
});

$router->add("/register", function() {
    global $root_path2;
    require "$root_path2/pages/register-page.php";
});

$router->add("/pages/mitinskii-les", function() {
    global $root_path2;
    require "$root_path2/pages/mitinskii-les.php";
});

//var_dump($path);
//echo '$root_path2: ' . $root_path2;
//echo '<div>'. '$path: ' . $path . '</div>';
$router->dispatch($path);

/*echo 'req: ' . $request;
switch (true) {
    case $request == '/':
//        echo $_SERVER['DOCUMENT_ROOT'];///var/www/html/homes_staging/public_html
        require "$root_path2/pages/main-page.php";
//        echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
        break;
    case $request == '/page':
        echo "[15]router: new page";
        break;
    case $path == '/user':
        require "$root_path2/pages/user.php";
        break;
//    case preg_match("/^\/user/", $request ):
//        require "$root_path2/pages/user.php";
//        break;
    case str_starts_with($request, "/pages/mitinskii-les"):
        require "$root_path2/pages/mitinskii-les.php";
        break;
    default:
        echo "404 page";
}
*/
