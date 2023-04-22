<?php

namespace Resend;

use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

/**
 * @property array $data
 */
final class Collection extends Resource implements IteratorAggregate
{
    /**
     * {@inheritdoc}
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (is_string($offset)) {
            return parent::offsetGet($offset);
        }

        throw new InvalidArgumentException("You tried to access the {$offset} index, but Collection types only support string keys.");
    }
}
