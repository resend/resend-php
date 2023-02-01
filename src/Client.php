<?php

namespace Resend;

use Resend\Contracts\Transporter;

class Client
{
    /**
     * Create a new Client instance with the given transporter.
     */
    public function __construct(
        private readonly Transporter $transporter
    ) {
        //
    }

    /**
     * Send an email with the given parameters.
     */
    public function sendEmail(array $parameters)
    {
    }
}
