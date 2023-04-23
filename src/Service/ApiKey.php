<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

final class ApiKey extends Service
{
    /**
     * Create a new API key.
     */
    public function create(array $parameters): \Resend\ApiKey
    {
        $payload = Payload::create('api-keys', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }

    /**
     * List all API keys.
     *
     * @return \Resend\Collection<\Resend\ApiKey>
     */
    public function list(): \Resend\Collection
    {
        $payload = Payload::list('api-keys');

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }

    /**
     * Remove an API key with the given ID.
     */
    public function remove(string $id): \Resend\ApiKey
    {
        $payload = Payload::delete('api-keys', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }
}
