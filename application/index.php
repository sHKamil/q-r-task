<?php

function dd($dump) {
    return die(var_dump($dump));
}

const BASE_PATH = __DIR__ . '/';

require_once BASE_PATH . 'helpers/autoload.php';
require_once BASE_PATH . 'helpers/view.php';

spl_autoload_register('autoloader');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = new App\Router\Router;
$routes = require_once 'App/Router/web.php';
echo $router->route($uri);
