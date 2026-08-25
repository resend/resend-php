<?php

namespace Resend\Service\Webhooks;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class EventAttempt extends Service
{
    public function list(string $webhookId, string $eventId, array $options = []): \Resend\Collection
    {
        $options = array_intersect_key($options, array_flip(['limit', 'after']));
        $payload = Payload::list("webhooks/{$webhookId}/events/{$eventId}/attempts", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-event-attempts', $result);
    }
}
