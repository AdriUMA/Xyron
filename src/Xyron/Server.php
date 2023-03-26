<?php

namespace Xyron;

interface Server {
    public function getUri(): string;

    public function getMethod(): HttpMethod;

    public function getData(): array;

    public function getQuery(): array;
}