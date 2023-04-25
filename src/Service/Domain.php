<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

final class Domain extends Service
{
    /**
     * Add a new domain.
     */
    public function create(array $parameters): \Resend\Domain
    {
        $payload = Payload::create('domains', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * List all domains.
     *
     * @return \Resend\Collection<\Resend\Domain>
     */
    public function list(): \Resend\Collection
    {
        $payload = Payload::list('domains');

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Remove a domain with the given ID.
     */
    public function remove(string $id): \Resend\Domain
    {
        $payload = Payload::delete('domains', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Verify a domain with the given ID.
     */
    public function verify(string $id): \Resend\Domain
    {
        $payload = Payload::verify('domains', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }
}
