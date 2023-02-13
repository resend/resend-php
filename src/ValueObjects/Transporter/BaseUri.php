<?php

namespace Resend\ValueObjects\Transporter;

use Resend\Contracts\Stringable;

final class BaseUri implements Stringable
{
    /**
     * Create a new Base URI value object.
     */
    public function __construct(
        private readonly string $baseUri
    ) {
        //
    }

    /**
     * Create a new Base URI value object from the the given URI.
     */
    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }

    /**
     * Returns the string representation of the object.
     */
    public function toString(): string
    {
        return "https://{$this->baseUri}/";
    }
}
