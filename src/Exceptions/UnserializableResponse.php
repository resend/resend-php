<?php

namespace Resend\Exceptions;

use Exception;
use JsonException;

class UnserializableResponse extends Exception
{
    /**
     * @var string|null
     */
    protected $responseBody;

    /**
     * Create a new Unserializable Response exception.
     */
    public function __construct(JsonException $exception, ?string $responseBody = null)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
        $this->responseBody = $responseBody;
    }

    /**
     * Get the raw response body.
     */
    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }
}
