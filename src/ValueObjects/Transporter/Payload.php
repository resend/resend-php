<?php

namespace Resend\ValueObjects\Transporter;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Resend;
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
        private readonly array $parameters = [],
        private ?Headers $headers = null
    ) {
        //
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function list(string $resource, array $options = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $searchParams = [];

        if (array_key_exists('limit', $options)) {
            $searchParams['limit'] = $options['limit'];
        }

        if (array_key_exists('after', $options)) {
            $searchParams['after'] = $options['after'];
        }

        if (array_key_exists('before', $options)) {
            $searchParams['before'] = $options['before'];
        }

        $uri = ResourceUri::list(! empty($searchParams) ? $resource . '?' . http_build_query($searchParams) : $resource);

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function get(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::get($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function create(string $resource, array $parameters, array $options = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);
        $headers = new Headers([]);

        if (array_key_exists('idempotency_key', $options)) {
            $headers = $headers->withIdempotencyKey($options['idempotency_key']);
        }

        return new self($contentType, $method, $uri, $parameters, $headers);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function update(string $resource, string $id, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::PATCH;
        $uri = ResourceUri::update($resource, $id);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function delete(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::delete($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function verify(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::withAction($resource, $id, 'verify');

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new Transporter Payload instance.
     */
    public static function cancel(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::withAction($resource, $id, 'cancel');

        return new self($contentType, $method, $uri);
    }

    /**
     * Add the given header and value to the payload.
     */
    public function withHeader(string $header, string $value): self
    {
        $this->headers = $this->headers->with($header, $value);

        return $this;
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): RequestInterface
    {
        $body = null;

        $uri = $baseUri->toString() . $this->uri->toString();

        $mergedHeaders = $headers;
        if ($this->headers !== null) {
            $mergedHeaders = $headers->merge($this->headers);
        }

        $mergedHeaders = $mergedHeaders->withUserAgent('resend-php', Resend::VERSION)
            ->withContentType($this->contentType);

        if ($this->method === Method::POST || $this->method === Method::PATCH || $this->method === Method::PUT) {
            $body = json_encode(
                $this->parameters === [] || ! array_is_list($this->parameters) ? (object) $this->parameters : $this->parameters,
                JSON_THROW_ON_ERROR
            );
        }

        return new Request($this->method->value, $uri, $mergedHeaders->toArray(), $body);
    }
}
