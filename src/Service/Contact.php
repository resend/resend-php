<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Contact extends Service
{
    /**
     * List all contacts from an audience.
     */
    public function list(string $audienceId): \Resend\Collection
    {
        $payload = Payload::list("audiences/$audienceId/contacts");

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }
}
