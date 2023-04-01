<?php

namespace Xyron\Tests\Http;

use Xyron\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase {
    public function test_json_response_is_constructed_correctly() {
        // Construye una respuesta de tipo json usando el metodo correspondiente
        // y comprueba que el codigo de estado, las cabeceras y el contenido
        // son lo que te esperas.
        $response = Response::json(["message" => "Test"]);

        $response->getHeaders();

        $expectedCode = 200;
        $expectedContent = json_encode(["message" => "Test"]);
        $expectedHeaders = [
            "content-type" => "application/json",
            "content-length" => strlen($expectedContent),
        ];

        $this->assertEquals($response->getStatus(), $expectedCode);
        $this->assertEquals($response->getHeaders(), $expectedHeaders);
        $this->assertEquals($response->getContent(), $expectedContent);
    }

    public function test_text_response_is_constructed_correctly() {
        // Construye una respuesta de tipo texto plano usando el metodo
        // correspondiente y comprueba que el codigo de estado, las cabeceras y el
        // contenido son lo que te esperas.
        $response = Response::text("message");

        $response->getHeaders();

        $expectedCode = 200;
        $expectedContent = "message";
        $expectedHeaders = [
            "content-type" => "text/plain",
            "content-length" => strlen($expectedContent),
        ];

        $this->assertEquals($response->getStatus(), $expectedCode);
        $this->assertEquals($response->getHeaders(), $expectedHeaders);
        $this->assertEquals($response->getContent(), $expectedContent);
    }

    public function test_redirect_response_is_constructed_correctly() {
        // Construye una respuesta de tipo redirect usando el metodo
        // correspondiente y comprueba que el codigo de estado, las cabeceras y el
        // contenido son lo que te esperas.
        $response = Response::redirect("https://www.benalmatica.com");

        $response->getHeaders();

        $expectedCode = 302;
        $expectedHeaders = [
            "location" => "https://www.benalmatica.com",
        ];

        $this->assertEquals($response->getStatus(), $expectedCode);
        $this->assertEquals($response->getHeaders(), $expectedHeaders);
    }

    public function test_html_response_is_constructed_correctly() {
        // Construye una respuesta de tipo redirect usando el metodo
        // correspondiente y comprueba que el codigo de estado, las cabeceras y el
        // contenido son lo que te esperas.
        $response = Response::html("<body><h1>Test</h1></body>");
        
        $response->getHeaders();

        $expectedCode = 200;
        $expectedContent = "<body><h1>Test</h1></body>";
        $expectedHeaders = [
            "content-type" => "text/html",
            "content-length" => strlen($expectedContent),
        ];

        $this->assertEquals($response->getStatus(), $expectedCode);
        $this->assertEquals($response->getHeaders(), $expectedHeaders);
        $this->assertEquals($response->getContent(), $expectedContent);
    }

    public function test_prepare_method_removes_content_headers_if_there_is_no_content() {
        $response = Response::text("");

        $response->getHeaders();

        $expectedCode = 200;
        $expectedContent = "";
        $expectedHeaders = [
        ];

        $this->assertEquals($response->getStatus(), $expectedCode);
        $this->assertEquals($response->getHeaders(), $expectedHeaders);
        $this->assertEquals($response->getContent(), $expectedContent);
    }
}
