<?php

require "./HttpMethod.php";
require "./HttpNotFoundException.php";

class Router {
    // Creamos nuestro arrray que contendra todas las rutas en su respectivo protocolo http
    protected array $routes = [];

    // Constructor que deja los protocolos http listos en el array
    public function __construct()
    {
        foreach(HttpMethod::cases() as $method) {
            $this->routes[$method->value] = [];
        }
    }

    public function resolve(){
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["REQUEST_URI"];

        $action = $this->routes[$method][$uri] ?? null; // obtenemos la funcion dada la ruta y el metodo

        // Si la ruta no existe, excepcion
        if ($action == null){
            throw new HttpNotFoundException();
        }
        
        return $action;
    }

    // Setter de rutas (publico)
    public function add(HttpMethod $method, string $uri, callable $action){
        switch ($method) {
            case HttpMethod::GET:
                $this->get($uri, $action);
                break;
            case HttpMethod::POST:
                $this->post($uri, $action);
                break;
            case HttpMethod::PUT:
                $this->put($uri, $action);
                break;
            case HttpMethod::PATCH:
                $this->patch($uri, $action);
                break;
            case HttpMethod::DELETE:
                $this->delete($uri, $action);
                break;
            default:
                throw new HttpMethodUnknownException();
                break;
        }
    }

    // Setters de rutas (privados)
    private function get(string $uri, callable $action) {
        $this->routes[HttpMethod::GET->value][$uri] = $action;
    }

    private function post(string $uri, callable $action) {
        $this->routes[HttpMethod::POST->value][$uri] = $action;
    }

    private function put(string $uri, callable $action) {
        $this->routes[HttpMethod::PUT->value][$uri] = $action;
    }

    private function patch(string $uri, callable $action) {
        $this->routes[HttpMethod::PATCH->value][$uri] = $action;
    }

    private function delete(string $uri, callable $action) {
        $this->routes[HttpMethod::DELETE->value][$uri] = $action;
    }

}