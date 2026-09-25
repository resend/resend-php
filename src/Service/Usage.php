<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Usage extends Service
{
    /**
     * Retrieve the caller's account-level usage and quota data.
     *
     * @see https://resend.com/docs/api-reference/usage/get-usage
     */
    public function get(): \Resend\Usage
    {
        $payload = Payload::list('usage');

        $result = $this->transporter->request($payload);

        return $this->createResource('usage', $result);
    }
}
