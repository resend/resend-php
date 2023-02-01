<?php

namespace Resend\ValueObjects\Transporter;

use GuzzleHttp\Psr7\Request;
use Resend\Enums\Transporter\ContentType;
use Resend\Enums\Transporter\Method;
use Resend\ValueObjects\ResourceUri;

final class Payload
{
    public function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = []
    ) {
        //
    }

    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): Request
    {
        $body = null;
        $uri = $baseUri->toString() . $this->uri->toString();

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            $body = json_encode($this->parameters, JSON_THROW_ON_ERROR);
        }

        return new Request($this->method->value, $uri, $headers->toArray(), $body);
    }
}
