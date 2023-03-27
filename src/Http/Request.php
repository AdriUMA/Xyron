<?php

namespace Xyron\Http;

use Xyron\Server\Server;

/**
 * Request from users
 */
class Request {
    /**
     * Request URI
     *
     * @var string
     */
    protected string $uri;
    /**
     * Request Method
     *
     * @var HttpMethod
     */
    protected HttpMethod $method;
    /**
     * Request data. GET data by default.
     *
     * @var array
     */
    protected array $data;
    /**
     * Request query. POST data by default.
     *
     * @var array
     */
    protected array $query;

    /**
     * Request Constructor
     *
     * @param Server $server
     */
    public function __construct(Server $server) {
        $this->uri = $server->getUri();
        $this->method = $server->getMethod();
        $this->data = $server->getData();
        $this->query = $server->getQuery();
    }

    /**
     * URI getter
     *
     * @return string
     */
    public function getUri(): string {
        return $this->uri; // "POST"
    }
    
    /**
     * Method getter
     *
     * @return HttpMethod
     */
    public function getMethod(): HttpMethod {
        return $this->method;
    }
}