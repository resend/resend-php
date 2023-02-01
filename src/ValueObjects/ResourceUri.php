<?php

namespace Resend\ValueObjects;

use Resend\Contracts\Stringable;

final class ResourceUri implements Stringable
{
    /**
     * Create a new Resource URI value object.
     */
    public function __construct(
        private readonly string $uri
    ) {
        //
    }

    public static function create(string $resource): self
    {
        return new self($resource);
    }

    public function toString(): string
    {
        return $this->uri;
    }
}
