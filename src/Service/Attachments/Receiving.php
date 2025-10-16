<?php

namespace Resend\Service\Attachments;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Receiving extends Service
{
    /**
     * Retrieve an attachment for an inbound email.
     *
     * @see https://resend.com/docs/api-reference/attachments/retrieve-inbound-email-attachment
     */
    public function get(string $emailId, string $id): \Resend\Attachments\Receiving
    {
        $payload = Payload::get("emails/receiving/$emailId/attachments", $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('attachments.receiving', $result);
    }

    /**
     * List all attachments and their contents for the given ID.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Attachments\Receiving>
     *
     * @see https://resend.com/docs/api-reference/attachments/list-inbound-email-attachments
     */
    public function list(string $emailId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("emails/receiving/$emailId/attachments", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('attachments.receiving', $result);
    }
}
