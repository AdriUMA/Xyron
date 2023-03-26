<?php

require_once "../vendor/autoload.php";

use Xyron\HttpMethod;
use Xyron\HttpNotFoundException;
use Xyron\Router;

$router = new Router();
$method = HttpMethod::GET;

$router->add(HttpMethod::GET, '/test', function(){
    return "GET OK";
});

$router->add(HttpMethod::POST, '/test', function(){
    return "POST OK";
});

$router->add(HttpMethod::PUT, '/test', function(){
    return "PUT OK";
});

$router->add(HttpMethod::PATCH, '/test', function(){
    return "PATCH OK";
});

$router->add(HttpMethod::DELETE, '/test', function(){
    return "DELETE OK";
});


try {
    $action = $router->resolve();
    print($action());
}catch (HttpNotFoundException){
    print("Not found");
    http_response_code(404);
}