<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class ContactProperty extends Service
{
    /**
     * Retrieve a single contact property.
     *
     * @see https://resend.com/docs/api-reference/contact-properties/get-contact-property
     */
    public function get(string $id): \Resend\ContactProperty
    {
        $payload = Payload::get('contact-properties', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-properties', $result);
    }

    /**
     * Create a new contact property.
     *
     * @see https://resend.com/docs/api-reference/contact-properties/create-contact-property
     */
    public function create(array $parameters): \Resend\ContactProperty
    {
        $payload = Payload::create('contact-properties', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-properties', $result);
    }

    /**
     * List all contact properties.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\ContactProperty>
     *
     * @see https://resend.com/docs/api-reference/contact-properties/list-contact-properties
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('contact-properties', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-properties', $result);
    }

    /**
     * Update a contact property with the given ID.
     *
     * @see https://resend.com/docs/api-reference/contact-properties/update-contact-property
     */
    public function update(string $id, array $parameters): \Resend\ContactProperty
    {
        $payload = Payload::update('contact-properties', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-properties', $result);
    }

    /**
     * Remove a contact property with the given ID.
     *
     * @see https://resend.com/docs/api-reference/contact-properties/delete-contact-property
     */
    public function remove(string $id): \Resend\ContactProperty
    {
        $payload = Payload::delete('contact-properties', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('contact-properties', $result);
    }
}
