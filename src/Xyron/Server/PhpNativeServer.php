<?php

namespace Xyron\Server;

use Xyron\Http\HttpMethod;

class PhpNativeServer implements Server {
    public function getUri(): string {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    public function getMethod(): HttpMethod {
        return HttpMethod::from($_SERVER["REQUEST_METHOD"]);
    }

    public function getData(): array {
        return $_POST;
    }

    public function getQuery(): array {
        return $_GET;
    }
}