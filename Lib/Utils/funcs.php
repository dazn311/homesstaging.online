<?php

use JetBrains\PhpStorm\NoReturn;
use Utils\{App, Db, Router};

function dump($data): void
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function print_arr($data): void
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

#[NoReturn] function dd($data): void
{
    dump($data);
    die;
}

#[NoReturn] function abort($code = 404, $title = '404 - Not found'): void
{
    http_response_code($code);
    require VIEWS . "/errors/{$code}.tpl.php";
    die;
}
/**
load fillable from $_POST , $_GET;
 */
function load($fillable = [], $isPost = true): array
{
  $loadData = $isPost ? $_POST : $_GET;

  $data = [];
  foreach ($fillable as $key) {
    $value = $loadData[$key] ?? null;
    if (isset($value)) {
      $data[$key] = is_array($value) ? $value : trim($value);
    } else {
      $data[$key] = '';
    }
  }

  return $data;
}
function loadOfKeys($keyPref = 'worksPerformed_', $isPost = true): array
{
  $loadData = $isPost ? $_POST : $_GET;
  $data = [];
  foreach ($loadData as $key=>$value) {//worksPerformed_0
    if (str_contains($key, $keyPref)) {
      $k = str_replace($keyPref, '', $key);
      $data[$k] = is_array($value) ? $value : trim($value);
    }
  }

  return $data;
}

function old($fieldName): string
{
    return isset($_POST[$fieldName]) ? h($_POST[$fieldName]) : '';
}

function oldCheck($fieldName): string
{
    if (isset($_POST[$fieldName])) {
       return $_POST[$fieldName] == 'on' ? 'checked' : '';
    }
    return '';
}

function h($str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

#[NoReturn] function redirect($url = ''): void
{
    if ($url) {
        $redirect = $url;
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? PATH;
    }
    header("Location: {$redirect}");
    die;
}

function get_alerts(): void
{
    if (!empty($_SESSION['success'])) {
        require_once VIEWS . '/incs/alert_success.php';
        unset($_SESSION['success']);
    }
    if (!empty($_SESSION['error'])) {
        require_once VIEWS . '/incs/alert_error.php';
        unset($_SESSION['error']);
    }
}

function db(): Db
{
    return App::get(Db::class);
}

function check_auth(): bool
{
    return isset($_SESSION['user']);
}

function get_file_ext($file_name): false|string
{
    $file_ext = explode('.', $file_name);
    return end($file_ext);
}

function route_params(): array
{
    return Router::$route_params;
}
function route_param(string $key, $default = null): string|null
{
    return Router::$route_params[$key] ?? $default;
}
function getHeader(): array
{
    $is401 = false;
    $cookies = [];
    $headers = [];
    if (isset($http_response_header)) {
        foreach ($http_response_header as $header) {
            $headers[] = $header;
            if (preg_match('/^Set-Cookie:\s*(.*?)$/i', $header, $matches)) {
                var_dump($matches);
                $rea125 = explode('=',$matches[1]);
                setcookie($rea125[0], $rea125[1], time() + (86400 * 30), '/', 'localhost:8085', false, false);
                $cookies[] = $matches[1];

            }
            //  HTTP/1.1 401 Unauthorized
            if (preg_match('#^HTTP/1.1 (\d+) Unauthorized$#', $header, $matches)) {
                if ($matches[1] === '401') {
                    $is401 = true;
                }
            }
//            var_dump($header);
        }
    }
//    var_dump($cookies);
    return [
        'is401' => $is401,
        'cookies' => $cookies,
        'headers' => $headers,
    ];
}
