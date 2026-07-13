<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Batch extends Service
{
    /**
     * Send a batch of emails with the given parameters.
     *
     * @param array<int, array{
     *     from: string,
     *     to: string|array<int, string>,
     *     subject?: string,
     *     html?: string,
     *     text?: string,
     *     bcc?: string|array<int, string>,
     *     cc?: string|array<int, string>,
     *     reply_to?: string|array<int, string>,
     *     headers?: array<string, string>,
     *     topic_id?: string|null,
     *     tags?: array<int, array{name: string, value: string}>,
     *     template?: array{id: string, variables?: array<string, string|int>}
     * }> $parameters
     * @param array{'idempotency_key'?: string, 'batch_validation'?: 'strict'|'permissive'} $options
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
     * @param array<int, array{
     *     from: string,
     *     to: string|array<int, string>,
     *     subject?: string,
     *     html?: string,
     *     text?: string,
     *     bcc?: string|array<int, string>,
     *     cc?: string|array<int, string>,
     *     reply_to?: string|array<int, string>,
     *     headers?: array<string, string>,
     *     topic_id?: string|null,
     *     tags?: array<int, array{name: string, value: string}>,
     *     template?: array{id: string, variables?: array<string, string|int>}
     * }> $parameters
     * @param array{'idempotency_key'?: string, 'batch_validation'?: 'strict'|'permissive'} $options
     * @return \Resend\Collection<\Resend\Email>
     *
     * @see https://resend.com/docs/api-reference/emails/send-batch-emails
     */
    public function send(array $parameters, array $options = []): \Resend\Collection
    {
        return $this->create($parameters, $options);
    }
}
