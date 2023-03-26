<?php

namespace Xyron\Http;

class Response {
    protected int $status = 200;
    protected $headers = [];
    protected ?string $content = null;

    // Getters
    public function getStatus(): int {
        return $this->status;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getHeaders(): array {
        return $this->headers;
    }
    
    // Setters
    public function setStatus(int $status) {
        $this->status = $status;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function setHeader(string $header, string $value) {
        $this->headers[strtolower($header)] = $value;
    }

    // Others
    public function removeHeader(string $header) {
        unset($this->headers[strtolower($header)]);
    }
    
    public function prepareHeader() {
        // PHP envia por defecto cabeceras, si las modificas, pueden ser omitidas.
        header("Content-Type: None");
        header_remove("Content-Type");

        if ($this->content == null){
            $this->removeHeader("Content-Type");
            $this->removeHeader("Content-Length");
        }else {
            $this->setHeader("Content-Length", strlen($this->content));
        }
    }
}