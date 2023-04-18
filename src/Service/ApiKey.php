<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

final class ApiKey extends Service
{
    public function all()
    {
        $payload = Payload::list('api-keys');

        $result = $this->transporter->request($payload);

        return $this->createResource('api-keys', $result);
    }
}
