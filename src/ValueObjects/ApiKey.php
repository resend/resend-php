<?php

namespace Resend\ValueObjects;

final class ApiKey
{
    /**
     * Create a new API Token value object.
     */
    public function __construct(
        public readonly string $apiKey
    ) {
        //
    }

    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    public function toString(): string
    {
        return $this->apiKey;
    }
}
