<?php

namespace Xyron\Tests\Http;

use Xyron\Http\HttpMethod;
use Xyron\Http\Request;
use Xyron\Server\Server;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase {
    private function createMockRequest(string $uri, HttpMethod $method, array $data, array $query): Request{
        $mockServer = $this->getMockBuilder(Server::class)->getMock();
        $mockServer->method("getUri")->willReturn($uri);
        $mockServer->method("getMethod")->willReturn($method);
        $mockServer->method("getData")->willReturn($data);
        $mockServer->method("getQuery")->willReturn($query);

        return new Request($mockServer);
    }

    public function test_request_returns_data_obtained_from_server_correctly() {
        // Crea un objeto de tipo Xyron\Http\Request. Utiliza los setters para
        // poner el valor de la URI, el metodo HTTP, los query parameters y
        // el POST data. Despues comprueba que que los getters devuelven
        // lo que has puesto.

        $uri = "/Unit/Testing";
        $method = HttpMethod::GET;
        $data = ["asdasdasdasdasdasdasdasd"];
        $query = ["The query test", "tal"];

        $request = $this->createMockRequest($uri, $method, $data, $query);

        $this->assertEquals($uri, $request->getUri());
        $this->assertEquals($data, $request->getData());
        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals($query, $request->getQuery());
    }
}
