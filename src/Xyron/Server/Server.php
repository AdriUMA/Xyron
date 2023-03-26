<?php

namespace Xyron\Server;

use Xyron\Http\HttpMethod;

interface Server {
    public function getUri(): string;

    public function getMethod(): HttpMethod;

    public function getData(): array;

    public function getQuery(): array;
}