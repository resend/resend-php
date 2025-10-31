<?php

namespace Resend\Service\Emails;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Attachment extends Service
{
    /**
     * Retrieve a single attachment from a sent email.
     *
     * @see https://resend.com/docs/api-reference/attachments/retrieve-sent-email-attachment
     */
    public function get(string $emailId, string $id): \Resend\Emails\Attachment
    {
        $payload = Payload::get("emails/$emailId/attachments", $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('attachments', $result);
    }

    /**
     * Retrieve a list of email attachments and their contents for the given email ID.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Emails\Attachment>
     *
     * @see https://resend.com/docs/api-reference/attachments/list-sent-email-attachments
     */
    public function list(string $emailId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("emails/$emailId/attachments", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('attachments', $result);
    }
}
