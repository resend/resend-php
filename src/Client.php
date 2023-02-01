<?php

namespace Resend;

use Resend\Contracts\Transporter;
use Resend\Responses\Email\EmailSent;
use Resend\ValueObjects\Transporter\Payload;

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
    public function sendEmail(array $parameters): EmailSent
    {
        $payload = Payload::create('email', $parameters);

        $result = $this->transporter->request($payload);

        return EmailSent::from($result);
    }
}
