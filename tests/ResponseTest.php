<?php

namespace Xyron\Tests;

use PHPUnit\Framework\TestCase;
use Xyron\Http\HttpMethod;
use Xyron\Http\Request;
use Xyron\Server\Server;

class ResponseTest extends TestCase {
    private function createMockRequest(string $uri, HttpMethod$method): Request {
        $mockServer = $this->getMockBuilder(Server::class)->getMock();
        $mockServer->method("getUri")->willReturn($uri);
        $mockServer->method("getMethod")->willReturn($method);
    
        return new Request($mockServer);
    }
}