<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Batch extends Service
{
    /**
     * Send a batch of emails with the given parameters.
     *
     * @param array{'idempotency_key'?: string, 'batch_validation'?: string} $options
     * @return \Resend\Collection<\Resend\Email>
     *
     * @see https://resend.com/docs/api-reference/emails/send-batch-emails
     */
    public function create(array $parameters, array $options = []): \Resend\Collection
    {
        $payload = Payload::create('emails/batch', $parameters, $options);

        $payload->withHeader('x-batch-validation', $options['batch_validation'] ?? 'strict');

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Send a batch of emails with the given parameters.
     *
     * @param array{'idempotency_key'?: string, 'batch_validation'?: string} $options
     * @return \Resend\Collection<\Resend\Email>
     *
     * @see https://resend.com/docs/api-reference/emails/send-batch-emails
     */
    public function send(array $parameters, array $options = []): \Resend\Collection
    {
        return $this->create($parameters, $options);
    }
}
