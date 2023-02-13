<?php

namespace Resend\Concerns;

use BadMethodCallException;

trait ArrayAccessible
{
    /**
     * Determine whether an offset exists.
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * Get the given offset.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    /**
     * Assign a value to the specified offset
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    /**
     * Unset an offset
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
