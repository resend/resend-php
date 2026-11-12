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

    /**
     * Move the Forge return path and re-verify. Returns the full domain.
     * After the domain verifies, the API refuses this with a 422
     * `return_path_unavailable` error.
     *
     * @param array{return_path: string} $parameters
     */
    public function update(string $id, array $parameters): \Resend\Domain
    {
        if (trim($id) === '') {
            throw new InvalidArgumentException('The domain ID must be a non-empty string.');
        }

        $payload = Payload::update("domains/{$id}", 'forge', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Trigger an asynchronous Forge verification. Answers with the
     * `{object: 'domain', id}` pair like the classic domain verify;
     * poll `domains->get()` for state.
     */
    public function verify(string $id): \Resend\Domain
    {
        if (trim($id) === '') {
            throw new InvalidArgumentException('The domain ID must be a non-empty string.');
        }

        $payload = Payload::verify("domains/{$id}", 'forge');

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }
}
