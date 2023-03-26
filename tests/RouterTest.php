<?php

namespace Xyron\Tests;

use PHPUnit\Framework\TestCase;
use Xyron\HttpMethod;
use Xyron\HttpNotFoundException;
use Xyron\Request;
use Xyron\Router;
use Xyron\Server;

use function PHPUnit\Framework\assertEquals;

class RouterTest extends TestCase {
    private function createMockRequest(string $uri, HttpMethod $method): Request {
        $mockServer = $this->getMockBuilder(Server::class)->getMock();
        $mockServer->method("getUri")->willReturn($uri);
        $mockServer->method("getMethod")->willReturn($method);
    
        return new Request($mockServer);
    }

    public function test_resolve_basic_router_with_callback_action(){
        $uri = "/test";
        $action = fn() => "test";
        $router = new Router();
        $router->add(HttpMethod::GET, $uri, $action);

        $this->assertEquals($action, $router->resolve($this->createMockRequest($uri, HttpMethod::GET)));
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
                assertEquals($action, $router->resolve($this->createMockRequest($uri, $method)));
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
                $router->resolve($this->createMockRequest($uri, $method));
            }catch(HttpNotFoundException){
                $exceptions++;
            }
        }
        print($exceptions);
        print(" Exceptions");
    }

}