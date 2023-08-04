<?php 
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/config.php';
use Yosicare\Task\Config;

$requestPath = $_SERVER['REQUEST_URI'];

$requestPath = strtok($requestPath, '?');
$requestPath = ltrim($requestPath, '/');
$requestPath = str_replace(Config::APP_PATH,'',$requestPath);

$routes = array(
    '/' => __DIR__.'/src/Views/home.php',
    '/list' => __DIR__.'/src/Views/list.php',
    '/view' => __DIR__.'/src/Views/view.php',
    '/api/list' => __DIR__.'/src/Api/list.php',
    '/api/insert' => __DIR__.'/src/Api/insert.php',
    '/api/zipcode' => __DIR__.'/src/Api/zipcode.php',
    '/api/check-email' => __DIR__.'/src/Api/check-email.php',
    '/api/update' => __DIR__.'/src/Api/edit.php',
    '/api/delete' => __DIR__.'/src/Api/delete.php',
);

if (isset($routes[$requestPath])) {
    include $routes[$requestPath];
} else {
    include __DIR__.'/src/Views/404.php';
}