<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;
use Resend\WebhookSignature;

class Webhook extends Service
{
    /**
     * Retrieve a webhook with the given ID.
     *
     * @see https://resend.com/docs/api-reference/webhooks/get-webhook
     */
    public function get(string $id): \Resend\Webhook
    {
        $payload = Payload::get('webhooks', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhooks', $result);
    }

    /**
     * Create a new webhook.
     *
     * @see https://resend.com/docs/api-reference/webhooks/create-webhook
     */
    public function create(array $parameters): \Resend\Webhook
    {
        $payload = Payload::create('webhooks', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhooks', $result);
    }

    /**
     * List all webhooks.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Webhook>
     *
     * @see https://resend.com/docs/api-reference/webhooks/list-webhooks
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('webhooks', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhooks', $result);
    }

    /**
     * Update a webhook with the given ID.
     *
     * @see https://resend.com/docs/api-reference/webhooks/update-webhook
     */
    public function update(string $id, array $parameters): \Resend\Webhook
    {
        $payload = Payload::update('webhooks', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhooks', $result);
    }

    /**
     * Remove a webhook with the given ID.
     *
     * @see https://resend.com/docs/api-reference/webhooks/delete-webhook
     */
    public function remove(string $id): \Resend\Webhook
    {
        $payload = Payload::delete('webhooks', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhooks', $result);
    }

    /**
     * Determine if the incoming webhook request is valid.
     */
    public function verify(string $payload, array $headers, string $secret, ?int $tolerance = 300): bool
    {
        return WebhookSignature::verify($payload, $headers, $secret, $tolerance);
    }
}
