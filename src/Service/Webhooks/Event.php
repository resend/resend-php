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

    /**
     * Retrieve a list of events delivered to a webhook.
     *
     * @param array{'limit'?: int, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Webhooks\Event>
     *
     * @see https://resend.com/docs/api-reference/webhooks/list-events
     */
    public function list(string $webhookId, array $options = []): \Resend\Collection
    {
        $options = array_intersect_key($options, array_flip(['limit', 'after']));
        $payload = Payload::list("webhooks/{$webhookId}/events", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-events', $result);
    }

    /**
     * Retrieve a single event delivered to a webhook.
     *
     * @see https://resend.com/docs/api-reference/webhooks/get-event
     */
    public function get(string $webhookId, string $eventId): \Resend\Webhooks\Event
    {
        $payload = Payload::get("webhooks/{$webhookId}/events", $eventId);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-events', $result);
    }

    /**
     * Replay a single event delivered to a webhook.
     *
     * @see https://resend.com/docs/api-reference/webhooks/replay-event
     */
    public function replay(string $webhookId, string $eventId): \Resend\Webhooks\Event
    {
        $payload = Payload::withAction("webhooks/{$webhookId}/events", $eventId, 'replay');

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-events', $result);
    }
}
