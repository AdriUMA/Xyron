<?php

namespace Xyron\Http;

use Xyron\Server\Server;

class Request {
    protected string $uri;
    protected HttpMethod $method;
    protected array $data;
    protected array $query;

    public function __construct(Server $server) {
        $this->uri = $server->getUri();
        $this->method = $server->getMethod();
        $this->data = $server->getData();
        $this->query = $server->getQuery();
    }

    public function getUri(): string {
        return $this->uri;
    }

    public function getMethod(): HttpMethod {
        return $this->method;
    }
}