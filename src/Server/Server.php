<?php

namespace Xyron\Server;

use Xyron\Http\HttpMethod;
use Xyron\Http\Response;

/**
 * Server interface
 */
interface Server {
    /**
     * URI getter
     *
     * @return string
     */
    public function getUri(): string;
    /**
     * Method getter
     *
     * @return HttpMethod
     */
    public function getMethod(): HttpMethod;
    /**
     * Data getter
     *
     * @return array POST
     */
    public function getData(): array;
    /**
     * Query getter
     *
     * @return array GET
     */
    public function getQuery(): array;
    /**
     * Send response
     *
     * @param Response $response
     * @return void
     */
    public function sendResponse(Response $response);
}