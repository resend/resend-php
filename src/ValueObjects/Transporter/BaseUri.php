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

    public function toString(): string
    {
        return "https://{$this->baseUri}/";
    }
}
