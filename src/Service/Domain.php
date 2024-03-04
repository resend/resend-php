<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Domain extends Service
{
    /**
     * Retrieve a domain with the given ID.
     *
     * @see https://resend.com/docs/api-reference/domains/get-domain
     */
    public function get(string $id): \Resend\Domain
    {
        $payload = Payload::get('domains', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Add a new domain.
     *
     * @see https://resend.com/docs/api-reference/domains/create-domain#body-parameters
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
     *
     * @see https://resend.com/docs/api-reference/domains/list-domains
     */
    public function list(): \Resend\Collection
    {
        $payload = Payload::list('domains');

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Update a domain with the given ID.
     *
     * @see https://resend.com/docs/api-reference/domains/update-domain
     */
    public function update(string $id, array $parameters): \Resend\Domain
    {
        $payload = Payload::update('domains', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Remove a domain with the given ID.
     *
     * @see https://resend.com/docs/api-reference/domains/delete-domain#path-parameters
     */
    public function remove(string $id): \Resend\Domain
    {
        $payload = Payload::delete('domains', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Verify a domain with the given ID.
     *
     * @see https://resend.com/docs/api-reference/domains/verify-domain#path-parameters
     */
    public function verify(string $id): \Resend\Domain
    {
        $payload = Payload::verify('domains', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }
}
