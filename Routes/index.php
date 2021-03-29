<?php
require_once __DIR__ . "./Router.php";

$router = new Router();

$router->on("GET", '/', function () {
    return file_get_contents("/path/to/home/index.html");
})->post('/(\w+)/(\w+)/(\w+)', function ($module, $class, $method) {
    var_dump([$module, $class, $method]);
})->get('/view/(\w+)', function ($view) {
    ob_start();
    require dirname(__DIR__) . "/view/{$view}.html";
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
})->get('/(.*)', function ($uri) {
    return file_get_contents("/path/to/defaults/always-showed.html");
});

require_once __DIR__ . "/Users/Users.routes.php";

print $router($router->method(), $router->uri());
