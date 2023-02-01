<?php

namespace Resend\ValueObjects\Transporter;

use Resend\Enums\Transporter\ContentType;
use Resend\ValueObjects\ApiKey;

final class Headers
{
    /**
     * Create a new Headers value object.
     *
     * @param array<string, string> $headers
     */
    public function __construct(
        private readonly array $headers
    ) {
        //
    }

    /**
     * Create a new Headers value object with the given API key.
     */
    public static function withAuthorization(ApiKey $apiKey): self
    {
        return new self([
            'Authorization' => "Bearer {$apiKey->toString()}",
        ]);
    }

    public function withContentType(ContentType $contentType, string $suffix = ''): self
    {
        return new self([
            ...$this->headers,
            'Content-Type' => $contentType->value . $suffix,
        ]);
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
