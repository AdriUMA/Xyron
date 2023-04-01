<?php

namespace Xyron\Http;

/**
 * Responses from server
 */
class Response {
    /**
     * Response code
     *
     * @var integer
     */
    protected int $status = 200;
    /**
     * Response headers
     *
     * @var array<string,string>
     */
    protected $headers = [];
    /**
     * Response content
     *
     * @var string|null
     */
    protected ?string $content = null;

    // Getters
    /**
     * Status getter
     *
     * @return integer
     */
    public function getStatus(): int {
        return $this->status;
    }

    /**
     * Content getter
     *
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * Headers getter
     *
     * @return array<string, string>
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    // Setters
    /**
     * Status setter
     *
     * @param integer $status
     * @return self
     */
    public function setStatus(int $status): self {
        $this->status = $status;
        return $this;
    }

    /**
     * Content setter
     *
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

    /**
     * Headers setter
     *
     * @param string $header Header to add
     * @param string $value
     * @return self
     */
    public function setHeader(string $header, string $value): self {
        $this->headers[strtolower($header)] = $value;
        return $this;
    }

    // Others
    /**
     * Headers remover
     *
     * @param string $header Header to remove
     * @return void
     */
    public function removeHeader(string $header) {
        unset($this->headers[strtolower($header)]);
    }

    /**
     * An easier way to set most common content type headers
     *
     * @param ContentType $contentType
     * @return self
     */
    public function setContentType(ContentType $contentType): self {
        $this->setHeader("Content-Type", $contentType->value);
        return $this;
    }

    /**
     * Delete the content type if content is null. If content is not null, this function add the content length header
     *
     * @return self
     */
    public function prepareHeader(): self {
        // PHP envia por defecto cabeceras, si las modificas, pueden ser omitidas.
        header("Content-Type: None");
        header_remove("Content-Type");

        if ($this->content == null) {
            $this->removeHeader("Content-Type");
            $this->removeHeader("Content-Length");
        } else {
            $this->setHeader("Content-Length", strlen($this->content));
        }

        return $this;
    }

    // Factory
    /**
     * Response JSON factory
     *
     * @param array $data
     * @return self
     */
    public static function json(array $data): self {
        return (new Response())
            ->setContentType(ContentType::Json)
            ->setContent(json_encode($data))
            ->prepareHeader();
    }

    /**
     * Response plain text factory
     *
     * @param string $data
     * @return self
     */
    public static function text(string $data): self {
        return (new Response())
            ->setContentType(ContentType::Text)
            ->setContent($data)
            ->prepareHeader();
    }

    /**
     * Response HTML factory
     *
     * @param string $data
     * @return self
     */
    public static function html(string $data): self {
        return (new Response())
            ->setContentType(ContentType::Html)
            ->setContent($data)
            ->prepareHeader();
    }

    /**
     * Response redirect factory
     *
     * @param string $url
     * @return self
     */
    public static function redirect(string $url): self {
        return (new Response())
            ->setStatus(302)
            ->setHeader("Location", $url);
    }
}
