<?php

namespace Resend\Service\Broadcasts;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class ClickedLink extends Service
{
    /**
     * Retrieve a broadcast's clicked links.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Broadcasts\ClickedLink>
     *
     * @see https://resend.com/docs/api-reference/broadcasts/list-broadcast-clicked-links
     */
    public function list(string $broadcastId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("broadcasts/$broadcastId/clicked-links", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcast-clicked-links', $result);
    }
}
