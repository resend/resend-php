<?php

namespace Resend\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Error Exception instance.
     */
    public function __construct(private readonly array $contents)
    {
        parent::__construct($contents['message']);
    }
}
