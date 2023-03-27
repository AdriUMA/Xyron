<?php

namespace Xyron\Router;

use Xyron\Http\HttpMethod;
use Xyron\Http\HttpNotFoundException;
use Xyron\Http\Request;

/**
 * Routes Manager
 */
class Router {
    /**
     * Routes
     *
     * @var array<string,string> Protocol and URI
     */
    protected array $routes = [];

    /**
     * Router Constructor
     */
    public function __construct()
    {
        foreach(HttpMethod::cases() as $method) {
            $this->routes[$method->value] = [];
        }
    }

    /**
     * Resolve a request
     *
     * @param Request $request
     * @return void|callable
     * @throws HttpNotFoundException If the URI can not be resolved
     */
    public function resolve(Request $request){
        $action = $this->routes[$request->getMethod()->value][$request->getUri()] ?? null; 

        if (is_null($action)) throw new HttpNotFoundException();
        
        return $action;
    }

    /**
     * Add new route
     *
     * @param HttpMethod $method
     * @param string $uri
     * @param callable $action
     * @return self
     */
    public function add(HttpMethod $method, string $uri, callable $action): self {
        $this->{strtolower($method->value)}($uri,$action);
        return $this;
    }

    /**
     * Add GET route
     *
     * @param string $uri
     * @param callable $action
     * @return void
     */
    private function get(string $uri, callable $action) {
        $this->routes[HttpMethod::GET->value][$uri] = $action;
    }

    /**
     * Add POST route
     *
     * @param string $uri
     * @param callable $action
     * @return void
     */
    private function post(string $uri, callable $action) {
        $this->routes[HttpMethod::POST->value][$uri] = $action;
    }

    /**
     * Add PUT route
     *
     * @param string $uri
     * @param callable $action
     * @return void
     */
    private function put(string $uri, callable $action) {
        $this->routes[HttpMethod::PUT->value][$uri] = $action;
    }

    /**
     * Add PATCH route
     *
     * @param string $uri
     * @param callable $action
     * @return void
     */
    private function patch(string $uri, callable $action) {
        $this->routes[HttpMethod::PATCH->value][$uri] = $action;
    }

    /**
     * Add DELETE route
     *
     * @param string $uri
     * @param callable $action
     * @return void
     */
    private function delete(string $uri, callable $action) {
        $this->routes[HttpMethod::DELETE->value][$uri] = $action;
    }

}