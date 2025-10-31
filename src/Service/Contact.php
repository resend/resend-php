<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Contact extends Service
{
    /**
     * Retrieve a single contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/get-contact
     */
    public function get(string $idOrEmail): \Resend\Contact
    {
        $payload = Payload::get('contacts', $idOrEmail);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * Create a contact.
     *
     * @see https://resend.com/docs/api-reference/contacts/create-contact
     */
    public function create(array $parameters): \Resend\Contact
    {
        $payload = Payload::create('contacts', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * List all contacts.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Contact>
     *
     * @see https://resend.com/docs/api-reference/contacts/list-contacts
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('contacts', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * Update a contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/update-contacts
     */
    public function update(string $idOrEmail, array $parameters): \Resend\Contact
    {
        $payload = Payload::update('contacts', $idOrEmail, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }

    /**
     * Remove a contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/delete-contact
     */
    public function remove(string $idOrEmail): \Resend\Contact
    {
        $payload = Payload::delete('contacts', $idOrEmail);

        $result = $this->transporter->request($payload);

        return $this->createResource('contacts', $result);
    }
}
