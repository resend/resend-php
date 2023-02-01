<?php

namespace Resend\Contracts;

use ArrayAccess;

interface Response extends ArrayAccess
{
    /**
     * Returns the array representation of the Response.
     *
     * @return TArray
     */
    public function toArray(): array;
}
