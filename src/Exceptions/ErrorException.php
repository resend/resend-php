<?php

namespace Resend\Exceptions;

use Exception;

class ErrorException extends Exception
{
    /**
     * Creates a new Error Exception instance.
     */
    public function __construct(private readonly array $contents)
    {
        parent::__construct($contents['message']);
    }

    /**
     * Get the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Get the error type
     */
    public function getErrorType(): string
    {
        return $this->contents['type'];
    }

    /**
     * Get the error code.
     */
    public function getErrorCode(): int
    {
        return $this->contents['code'];
    }
}
