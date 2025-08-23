<?php

namespace Utils;
require 'print_info.php';
class GetLink
{
    public static array $linkAlias = [
        'main-page' => '/',
        'auth-page' => '/auth',
    ];
    public static function htmlUrl(string $url): string
    {
        return GetLink::$linkAlias[htmlspecialchars($url, ENT_QUOTES)];
    }
    public static function get(string $linkName): string
    {
//        $request = htmlspecialchars(explode('?', $_SERVER["REQUEST_URI"])[0],ENT_QUOTES);

        if (empty(GetLink::htmlUrl($linkName))) {
            return "L22";
        }
//        if (self::htmlUrl($linkName) === $request) {
//            return "L23";
//        }
        return GetLink::htmlUrl($linkName);
    }
}