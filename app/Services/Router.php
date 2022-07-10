<?php

namespace App\Services;

class Router
{
    private static $list = [];

    public static function test() {
        echo 123;
    }

    public static function page($url, $page_name)
    {
        self::$list[] = [
            'url' => $url,
            'page' => $page_name
        ];
    }

    public static function enable()
    {
        if ($_GET['q'] ?? '') {

            $query = $_GET['q'];

            foreach (self::$list as $route) {
                if ($route["url"] === '/' . $query) {
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                }
            }

            self::not_found_page();
        } else {
            require_once "views/pages/catalog.php";
        }
    }

    public static function not_found_page() {
        require_once 'views/errors/404.php';
    }

    public static function redirect($url) {
        header('Location: ' . $url);
    }
}