<?php

namespace Resend\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Resend\Enums\Transporter\ContentType;
use Resend\Enums\Transporter\Method;
use Resend\ValueObjects\ResourceUri;

final class Payload
{
    /**
     * Create a new Transporter Payload instance.
     */
    public function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = []
    ) {
        //
    }

    public static function list(string $resource): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    public static function delete(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::delete($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): RequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $body = null;

        $uri = $baseUri->toString() . $this->uri->toString();

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            $body = $psr17Factory->createStream(json_encode($this->parameters, JSON_THROW_ON_ERROR));
        }

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body !== null) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
