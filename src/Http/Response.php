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
    public function setStatus(int $status): self {
        $this->status = $status;
        return $this;
    }

    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

    public function setHeader(string $header, string $value): self {
        $this->headers[strtolower($header)] = $value;
        return $this;
    }

    // Others
    public function removeHeader(string $header) {
        unset($this->headers[strtolower($header)]);
    }
    
    public function setContentType(ContentType $contentType): self{
        $this->setHeader("Content-Type", $contentType->value);
        return $this;
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

    // Factory
    public static function json(array $data): self {
        return (new Response())
            ->setContentType(ContentType::Json)
            ->setContent(json_encode($data));
    }

    public static function text(string $data): self {
        return (new Response())
            ->setContentType(ContentType::Text)
            ->setContent($data);
    }

    public static function html(string $data): self {
        return (new Response())
            ->setContentType(ContentType::Html)
            ->setContent($data);
    }

    public static function redirect(string $url): self {
        return (new Response())
            ->setStatus(302)
            ->setHeader("Location", $url);
    }
}