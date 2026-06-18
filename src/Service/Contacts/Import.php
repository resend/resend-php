<?php

namespace Resend\Service\Contacts;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Import extends Service
{
    /**
     * Retrieve a single contact import.
     *
     * @see https://resend.com/docs/api-reference/contacts/get-contact-import
     */
    public function get(string $id): \Resend\Contacts\Import
    {
        $payload = Payload::get('contacts/imports', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-imports', $result);
    }

    /**
     * Create a contact import.
     *
     * @see https://resend.com/docs/api-reference/contacts/create-contact-import
     */
    public function create(array $parameters): \Resend\Contacts\Import
    {
        $payload = Payload::upload('contacts/imports', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-imports', $result);
    }

    /**
     * List all contact imports.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string, 'status'?: string} $options
     * @return \Resend\Collection<\Resend\Contacts\Import>
     *
     * @see https://resend.com/docs/api-reference/contacts/list-contact-imports
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('contacts/imports', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-imports', $result);
    }
}
