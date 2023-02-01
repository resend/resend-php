<?php

namespace Resend\Concerns;

use BadMethodCallException;

trait ArrayAccessible
{
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
