<?php
/**
 *  An example CORS-compliant method.  It will allow any GET, POST, or OPTIONS requests from any
 *  origin.
 *
 *  In a production environment, you probably want to be more restrictive, but this gives you
 *  the general idea of what is involved.  For the nitty-gritty low-down, read:
 *
 *  - https://developer.mozilla.org/en/HTTP_access_control
 *  - https://fetch.spec.whatwg.org/#http-cors-protocol
 *
 */
function cors() {
    // die(var_dump($_SERVER['HTTP_ORIGIN']));
    
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    } else {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header('Content-Type: application/json');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
        // $expires = time() + 3600 * 24; // Expires in 1 hour
        // header("Expires: " . gmdate("D, d M Y H:i:s", $expires) . " GMT");
        header("Expires: Mon, 26 Jul 2026 05:00:00 GMT"); // Immediately expire
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
    }

}