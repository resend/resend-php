<?php

namespace Resend\Service\Domains;

use InvalidArgumentException;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Forge extends Service
{
    /**
     * Enable Forge on a domain. Returns the full domain. Enabling an
     * already-migrated domain is idempotent and returns its current state.
     *
     * The `return_path` parameter is optional: when omitted, the server
     * picks a free DNS label.
     *
     * @param array{return_path?: string} $parameters
     */
    public function enable(string $id, array $parameters = []): \Resend\Domain
    {
        if (trim($id) === '') {
            throw new InvalidArgumentException('The domain ID must be a non-empty string.');
        }

        $payload = Payload::create("domains/{$id}/forge", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }
}
