<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Contact extends Service
{
    /**
     * Retrieve a single contact from an audience.
     *
     * @see https://resend.com/docs/api-reference/contacts/get-contact
     */
    public function get(string $audienceId, string $contactId): \Resend\Contact
    {
        $payload = Payload::get("audiences/$audienceId/contacts", $contactId);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * List all contacts from an audience.
     *
     * @return \Resend\Collection<\Resend\Contact>
     *
     * @see https://resend.com/docs/api-reference/contacts/list-contacts
     */
    public function list(string $audienceId): \Resend\Collection
    {
        $payload = Payload::list("audiences/$audienceId/contacts");

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }
}
