<?php

namespace Xyron\Tests;

use Xyron\HttpMethod;
use Xyron\Server;

class MockServer implements Server {
    private string $uri;
    private HttpMethod $method; 

    public function __construct(string $uri, HttpMethod $method) {
        $this->uri = $uri;  
        $this->method = $method;  
    }

    public function getUri(): string {
        return parse_url($this->uri, PHP_URL_PATH);
    }

    public function getMethod(): HttpMethod {
        return $this->method;
    }

    public function getData(): array {
        return [];
    }

    public function getQuery(): array {
        return [];
    }
}