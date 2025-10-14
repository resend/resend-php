<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Broadcast extends Service
{
    /**
     * Retrieve a single broadcast.
     *
     * @see https://resend.com/docs/api-reference/broadcasts/get-broadcast
     */
    public function get(string $id): \Resend\Broadcast
    {
        $payload = Payload::get('broadcasts', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }

    /**
     * Create a new broadcast to send to your audience.
     *
     * @see https://resend.com/docs/api-reference/broadcasts/create-broadcast
     */
    public function create(array $parameters): \Resend\Broadcast
    {
        $payload = Payload::create('broadcasts', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }

    /**
     * List all domains.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Broadcast>
     *
     * @see https://resend.com/docs/api-reference/broadcasts/list-broadcasts
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('broadcasts', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }

    /**
     * Update a broadcast to send to your audience.
     *
     * @see https://resend.com/docs/api-reference/broadcasts/update-broadcast
     */
    public function update(string $id, array $parameters): \Resend\Broadcast
    {
        $payload = Payload::update('broadcasts', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }

    /**
     * Start sending broadcasts to your audience.
     *
     * @see https://resend.com/docs/api-reference/broadcasts/send-broadcast
     */
    public function send(string $broadcastId, array $parameters): \Resend\Broadcast
    {
        $payload = Payload::create("broadcasts/{$broadcastId}/send", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }

    /**
     * Remove an existing broadcast.
     *
     * @see https://resend.com/docs/api-reference/broadcasts/delete-broadcast
     */
    public function remove(string $id): \Resend\Broadcast
    {
        $payload = Payload::delete('broadcasts', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('broadcasts', $result);
    }
}
