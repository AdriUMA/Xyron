<?php

namespace Xyron\Server;

use Xyron\Http\HttpMethod;
use Xyron\Http\Response;

interface Server {
    public function getUri(): string;
    public function getMethod(): HttpMethod;
    public function getData(): array;
    public function getQuery(): array;
    public function sendResponse(Response $response);
}