<?php

namespace Resend\Service\Webhooks;

use Resend\Contracts\Transporter;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Event extends Service
{
    public EventAttempt $attempts;

    public function __construct(Transporter $transporter)
    {
        $this->attempts = new EventAttempt($transporter);

        parent::__construct($transporter);
    }

    public function list(string $webhookId, array $options = []): \Resend\Collection
    {
        $options = array_intersect_key($options, array_flip(['limit', 'after']));
        $payload = Payload::list("webhooks/{$webhookId}/events", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-events', $result);
    }

    public function get(string $webhookId, string $eventId): \Resend\Webhooks\Event
    {
        $payload = Payload::get("webhooks/{$webhookId}/events", $eventId);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-events', $result);
    }
}
