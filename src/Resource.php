<?php

namespace Resend;

use Exception;
use Resend\Contracts\Resource as ResourceContract;

class Resource implements ResourceContract
{
    /**
     * The resources's attributes.
     */
    protected $attributes = [];

    /**
     * Create a new Resource instance.
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public static function from(array $attributes): static
    {
        return new static($attributes);
    }

    /**
     * Fill the resource with an array of attributes.
     */
    protected function fill(array $attributes): void
    {
        $fillable = $attributes;

        foreach ($fillable as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function getAttribute($name)
    {
        if (! $name) {
            return;
        }

        if (array_key_exists($name, $this->attributes)) {
            return $this->getAttributes()[$name] ?? null;
        }

        return null;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Convert the resource instance into an array.
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * Convert the resource instance into JSON.
     */
    public function toJson(int $options = 0): string
    {
        $json = json_encode($this->jsonSerialize(), $options);

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    /**
     * Dynamically retrieve attributes on the resource.
     */
    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    public function __debugInfo(): array
    {
        return $this->getAttributes();
    }

    public function offsetExists(mixed $offset): bool
    {
        try {
            return ! is_null($this->getAttribute($offset));
        } catch (Exception $e) {
            return false;
        }
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getAttribute($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        //
    }

    public function offsetUnset(mixed $offset): void
    {
        //
    }
}
