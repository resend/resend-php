<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class ApiKey extends Service
{
    /**
     * Create a new API key.
     *
     * @see https://resend.com/docs/api-reference/api-keys/create-api-key#body-parameters
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
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\ApiKey>
     *
     * @see https://resend.com/docs/api-reference/api-keys/list-api-keys
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('api-keys', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }

    /**
     * Remove an API key with the given ID.
     *
     * @see https://resend.com/docs/api-reference/api-keys/delete-api-key#path-parameters
     */
    public function remove(string $id): \Resend\ApiKey
    {
        $payload = Payload::delete('api-keys', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }
}
