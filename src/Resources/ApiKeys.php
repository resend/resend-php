<?php

namespace Resend\Resources;

use Resend\Concerns\Transportable;
use Resend\Contracts\Resource;
use Resend\ValueObjects\Transporter\Payload;

final class ApiKeys implements Resource
{
    use Transportable;

    public function create(array $parameters)
    {
        $payload = Payload::create('api-keys', $parameters);

        $result = $this->transporter->request($payload);

        return $result;
    }

    public function list()
    {
        $payload = Payload::list('api-keys');

        $result = $this->transporter->request($payload);

        return $result;
    }

    public function delete(string $apiKeyId)
    {
        $payload = Payload::delete('api-keys', $apiKeyId);

        $result = $this->transporter->request($payload);

        return $result;
    }
}
