<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Domains\Claim;
use Resend\Service\Domains\Forge;
use Resend\ValueObjects\Transporter\Payload;

class Domain extends Service
{
    public Claim $claims;

    public Forge $forge;

    /**
     * Create a new domain service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->claims = new Claim($transporter);
        $this->forge = new Forge($transporter);

        parent::__construct($transporter);
    }

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
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Domain>
     *
     * @see https://resend.com/docs/api-reference/domains/list-domains
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('domains', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }

    /**
     * Update a domain with the given ID.
     *
     * Pass `forge_return_path` to move the Forge return path; this does
     * not start a verification.
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
     * Pass `['scope' => ['forge']]` to re-check only the Forge record;
     * without a scope, the whole domain is verified as before.
     *
     * @param array{scope?: string[]} $parameters
     *
     * @see https://resend.com/docs/api-reference/domains/verify-domain#path-parameters
     */
    public function verify(string $id, array $parameters = []): \Resend\Domain
    {
        $payload = $parameters === []
            ? Payload::verify('domains', $id)
            : Payload::create("domains/{$id}/verify", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domains', $result);
    }
}
