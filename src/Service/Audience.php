<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Audience extends Service
{
    /**
     * Retrieve a single audience by the given ID.
     *
     * @see https://resend.com/docs/api-reference/audiences/get-audience
     */
    public function get(string $id): \Resend\Audience
    {
        $payload = Payload::get('audiences', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('audiences', $result);
    }

    /**
     * Add a new audience.
     *
     * @see https://resend.com/docs/api-reference/audiences/create-audience
     */
    public function create(array $parameters): \Resend\Audience
    {
        $payload = Payload::create('audiences', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('audiences', $result);
    }

    /**
     * List all audiences.
     *
     * @return \Resend\Collection<\Resend\Audience>
     *
     * @see https://resend.com/docs/api-reference/audiences/list-audiences
     */
    public function list(): \Resend\Collection
    {
        $payload = Payload::list('audiences');

        $result = $this->transporter->request($payload);

        return $this->createResource('audiences', $result);
    }

    /**
     * Remove a audience with the given ID.
     *
     * @see https://resend.com/docs/api-reference/audiences/delete-audience
     */
    public function remove(string $id): \Resend\Audience
    {
        $payload = Payload::delete('audiences', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('audiences', $result);
    }
}
