<?php

namespace Xyron\Server;

use Xyron\Http\HttpMethod;
use Xyron\Http\Response;

/**
 * Php native server implementation for Server interface
 */
class PhpNativeServer implements Server {
    /**
     * URI getter
     *
     * @return string
     */
    public function getUri(): string {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    /**
     * Method getter
     *
     * @return HttpMethod
     */
    public function getMethod(): HttpMethod {
        return HttpMethod::from($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * Data getter
     *
     * @return array POST
     */
    public function getData(): array {
        return $_POST;
    }

    /**
     * Query getter
     *
     * @return array GET
     */
    public function getQuery(): array {
        return $_GET;
    }

    /**
     * Send response
     *
     * @param Response $response
     * @return void
     */
    public function sendResponse(Response $response) {
        $response->prepareHeader();
        http_response_code($response->getStatus());
        foreach ($response->getHeaders() as $header => $value) {
            header("$header: $value");
        }
        print($response->getContent());
    }
}
