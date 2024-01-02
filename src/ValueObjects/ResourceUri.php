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

    /**
     * Create a new Resource URI value object that creates the given resource.
     */
    public static function create(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Create a new Resource URI value object that lists the given resource.
     */
    public static function list(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Create a new Resource URI value object that retrieves the given resource.
     */
    public static function get(string $resource, string $id): self
    {
        return new self("{$resource}/{$id}");
    }

    /**
     * Create a new Resource URI value object that updates the given resource.
     */
    public static function update(string $resource, string $id): self
    {
        return new self("{$resource}/{$id}");
    }

    /**
     * Create a new Resource URI value object that deletes the given resource.
     */
    public static function delete(string $resource, string $id): self
    {
        return new self("{$resource}/{$id}");
    }

    /**
     * Create a new Resource URI value object that verifies the given resource.
     */
    public static function verify(string $resource, string $id): self
    {
        return new self("{$resource}/{$id}/verify");
    }

    /**
     * Returns the string representation of the object.
     */
    public function toString(): string
    {
        return $this->uri;
    }
}
