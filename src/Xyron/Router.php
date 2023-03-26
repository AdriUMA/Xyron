<?php

namespace Xyron;

use function PHPUnit\Framework\isNull;

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

    /**
     * Ejecuta la funcion asignada a la ruta y al protocolo correspondiente
     * @param string $method Metodo ($_SERVER["REQUEST_METHOD"])
     * @param string $uri Ruta ($_SERVER["REQUEST_URI"])
     */
    public function resolve(string $method, string $uri){
        // obtenemos la funcion dada la ruta y el metodo
        $action = $this->routes[$method][$uri] ?? null; 

        // Si la ruta no existe, excepcion
        if (is_null($action)) {
            throw new HttpNotFoundException();
        }
        return $action;
    }

    // Setter de rutas (publico)
    /**
     * Incluye a una ruta una funcion dado su metodo
     *
     * @param HttpMethod $method Metodo
     * @param string $uri Ruta
     * @param callable $action Funcion
     */
    public function add(HttpMethod $method, string $uri, callable $action){
        $this->{strtolower($method->value)}($uri,$action);
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