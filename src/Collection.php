<?php

namespace Resend;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @property array $data
 */
final class Collection extends Resource implements IteratorAggregate
{
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }
}
