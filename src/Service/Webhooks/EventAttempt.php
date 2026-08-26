<?php

namespace Resend\Service\Webhooks;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class EventAttempt extends Service
{
    /**
     * Retrieve the delivery attempts for a webhook event.
     *
     * @param array{'limit'?: int, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Webhooks\EventAttempt>
     *
     * @see https://resend.com/docs/api-reference/webhooks/list-event-attempts
     */
    public function list(string $webhookId, string $eventId, array $options = []): \Resend\Collection
    {
        $options = array_intersect_key($options, array_flip(['limit', 'after']));
        $payload = Payload::list("webhooks/{$webhookId}/events/{$eventId}/attempts", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('webhook-event-attempts', $result);
    }
}
