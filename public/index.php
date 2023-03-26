<?php

use Xyron\Http\HttpMethod;
use Xyron\Http\HttpNotFoundException;
use Xyron\Http\Request;
use Xyron\Http\Response;
use Xyron\Router\Router;
use Xyron\Server\PhpNativeServer;

require_once "../vendor/autoload.php";


$router = new Router();

$router->add(HttpMethod::GET, '/test', function(){
    $response = Response::json(["message" => "GET OK"]);

    return $response;
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

$server = new PhpNativeServer();
try {
    $request = new Request($server);
    $action = $router->resolve($request);
    $response = $action();
    $server->sendResponse($response);
}catch (HttpNotFoundException){
    $response = Response::redirect("/test");
    $server->sendResponse($response);
}