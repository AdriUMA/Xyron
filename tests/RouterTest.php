<?php

namespace Xyron\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestStatus\Warning;
use Xyron\HttpMethod;
use Xyron\HttpNotFoundException;
use Xyron\Request;
use Xyron\Router;

use function PHPUnit\Framework\assertEquals;

class RouterTest extends TestCase {
    public function test_resolve_basic_router_with_callback_action(){
        $uri = "/test";
        $action = fn() => "test";
        $router = new Router();
        $router->add(HttpMethod::GET, $uri, $action);

        $this->assertEquals($action, $router->resolve(new Request(new MockServer($uri, HttpMethod::GET))));
    }

    public function test_resolve_multiple_basic_router_with_callback_action_for_all_http_methods(){
        $routes = [
            "/example-1" => fn () => "Example-1",
            "/example0" => fn () => "Example0",
            "/example1" => fn () => "Example1",
            "/example2" => fn () => "Example2",
            "/example/complex/nested" => fn () => "Example Nested",
        ];

        $router = new Router();

        foreach ($routes as $uri => $action) 
            foreach(HttpMethod::cases() as $method)
                $router->add($method, $uri, $action);
            
        foreach ($routes as $uri => $action) 
            foreach(HttpMethod::cases() as $method)
                assertEquals($action, $router->resolve(new Request(new MockServer($uri, $method))));
    }

    public function test_resolve_unknown_routes_for_all_http_methods(){
        $this->expectOutputString("25 Exceptions");
        
        $routes = [
            "/example-1" => fn () => "Example-1",
            "/example0" => fn () => "Example0",
            "/example1" => fn () => "Example1",
            "/example2" => fn () => "Example2",
            "/example/complex/nested" => fn () => "Example Nested",
        ];
        
        $router = new Router();
        $exceptions = 0;
        foreach ($routes as $uri => $action) 
        foreach(HttpMethod::cases() as $method){
            try{
                $router->resolve(new Request(new MockServer($uri, $method)));
            }catch(HttpNotFoundException){
                $exceptions++;
            }
        }
        print($exceptions);
        print(" Exceptions");
    }

}