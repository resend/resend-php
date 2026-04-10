<?php

namespace Resend\Service;

use InvalidArgumentException;
use Resend\ValueObjects\Transporter\Payload;

class Event extends Service
{
    /**
     * Retrieve a single event by ID or name.
     *
     * @see https://resend.com/docs/api-reference/events/get-event
     */
    public function get(string $identifier): \Resend\Event
    {
        $payload = Payload::get('events', $identifier);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }

    /**
     * Create a new event that can be used to trigger automations.
     *
     * @param array{name: string, schema?: array<string, 'string'|'number'|'boolean'|'date'>|null} $parameters
     *
     * @see https://resend.com/docs/api-reference/events/create-event
     */
    public function create(array $parameters): \Resend\Event
    {
        $payload = Payload::create('events', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }

    /**
     * List all events.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Event>
     *
     * @see https://resend.com/docs/api-reference/events/list-events
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('events', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }

    /**
     * Update an existing event schema.
     *
     * @param array{schema: array<string, 'string'|'number'|'boolean'|'date'>|null} $parameters
     *
     * @see https://resend.com/docs/api-reference/events/update-event
     */
    public function update(string $identifier, array $parameters): \Resend\Event
    {
        $payload = Payload::update('events', $identifier, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }

    /**
     * Remove an existing event.
     *
     * @see https://resend.com/docs/api-reference/events/delete-event
     */
    public function remove(string $identifier): \Resend\Event
    {
        $payload = Payload::delete('events', $identifier);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }

    /**
     * Send a named event to trigger matching automations.
     *
     * @param array{event: string, email?: string, contact_id?: string, payload?: array|object} $parameters
     *
     * @see https://resend.com/docs/api-reference/events/send-event
     */
    public function send(array $parameters): \Resend\Event
    {
        $hasEmail = array_key_exists('email', $parameters) && is_string($parameters['email']) && trim((string) $parameters['email']) !== '';
        $hasContactId = array_key_exists('contact_id', $parameters) && is_string($parameters['contact_id']) && trim((string) $parameters['contact_id']) !== '';

        if ($hasEmail === $hasContactId) {
            throw new InvalidArgumentException('Either contact_id or email must be provided, but not both.');
        }

        $payload = Payload::create('events/send', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('events', $result);
    }
}
