<?php

namespace Resend\Exceptions;

use Exception;
use JsonException;

final class UnserializableResponse extends Exception
{
    /**
     * Create a new Unserializable Response exception.
     */
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
