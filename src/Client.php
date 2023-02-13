<?php

namespace Resend;

use Resend\Contracts\Transporter;
use Resend\Responses\Email\Sent;
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
     *
     * @see https://resend.com/docs/api-reference/send-email#body-parameters
     */
    public function sendEmail(array $parameters): Sent
    {
        $payload = Payload::create('email', $parameters);

        $result = $this->transporter->request($payload);

        return Sent::from($result);
    }
}
