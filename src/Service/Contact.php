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
     * Add a contact to an audience.
     *
     * @see https://resend.com/docs/api-reference/contacts/create-contact
     */
    public function create(string $audienceId, array $parameters): \Resend\Contact
    {
        $payload = Payload::create("audiences/$audienceId/contacts", $parameters);

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

    /**
     * Update a contact in an audience.
     *
     * @see https://resend.com/docs/api-reference/contacts/update-contacts
     */
    public function update(string $audienceId, string $id, array $parameters): \Resend\Contact
    {
        $payload = Payload::update("audiences/$audienceId/contacts", $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * Remove a contact from an audience.
     *
     * @see https://resend.com/docs/api-reference/contacts/delete-contact
     */
    public function remove(string $audienceId, string $id): \Resend\Contact
    {
        $payload = Payload::delete("audiences/$audienceId/contacts", $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }
}
