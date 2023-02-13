<?php

namespace Resend\ValueObjects;

use Resend\Contracts\Stringable;

final class ApiKey implements Stringable
{
    /**
     * Create a new API Key value object.
     */
    public function __construct(
        public readonly string $apiKey
    ) {
        //
    }

    /**
     * Create a new API Key value object from the given API Key.
     */
    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * Returns the string representation of the object.
     */
    public function toString(): string
    {
        return $this->apiKey;
    }
}
