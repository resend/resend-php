<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

final class ApiKey extends Service
{
    /**
     * @return \Resend\ApiKey
     */
    public function create(array $parameters)
    {
        $payload = Payload::create('api-keys', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }

    /**
     * @return \Resend\Collection<\Resend\ApiKey>
     */
    public function list()
    {
        $payload = Payload::list('api-keys');

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }

    /**
     * @return \Resend\ApiKey
     */
    public function remove(string $id)
    {
        $payload = Payload::delete('api-keys', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }
}
