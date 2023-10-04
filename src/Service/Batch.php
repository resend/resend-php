<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Batch extends Service
{
    /**
     * Send a batch of emails with the given parameters.
     *
     * @return \Resend\Collection<\Resend\Email>
     *
     * @see https://resend.com/docs/api-reference/emails/send-batch-emails#body-parameters
     */
    public function create(array $parameters): \Resend\Collection
    {
        $payload = Payload::create('emails/batch', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Send a batch of emails with the given parameters.
     *
     * @return \Resend\Collection<\Resend\Email>
     *
     * @see https://resend.com/docs/api-reference/emails/send-batch-emails#body-parameters
     */
    public function send(array $parameters): \Resend\Collection
    {
        return $this->create($parameters);
    }
}
