<?php

require "./Router.php";
require "./HttpMethod.php";

$router = new Router();

$router->add(HttpMethod::GET, '/test', function(){
    return "chilsl";
});

$router->add(HttpMethod::POST, '/test', function(){
    return "eeeee no chill";
});

try {
    $action = $router->resolve();
    print($action());
}catch (HttpNotFoundException){
    print("Not found");
    http_response_code(404);
}