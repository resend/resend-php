<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Suppressions\Batch;
use Resend\ValueObjects\Transporter\Payload;

class Suppression extends Service
{
    public Batch $batch;

    /**
     * Create a new suppression service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->batch = new Batch($transporter);

        parent::__construct($transporter);
    }

    /**
     * Retrieve a single suppression by ID or email.
     *
     * @see https://resend.com/docs/api-reference/suppressions/get-suppression
     */
    public function get(string $idOrEmail): \Resend\Suppression
    {
        $payload = Payload::get('suppressions', $idOrEmail);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }

    /**
     * Add an email address to the suppression list.
     *
     * @param array{'email': string} $parameters
     * @see https://resend.com/docs/api-reference/suppressions/add-suppression
     */
    public function add(array $parameters): \Resend\Suppression
    {
        $payload = Payload::create('suppressions', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }

    /**
     * List all suppressions.
     *
     * @param array{'origin'?: string, 'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Suppression>
     *
     * @see https://resend.com/docs/api-reference/suppressions/list-suppressions
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('suppressions', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }

    /**
     * Remove a single suppression by ID or email.
     *
     * @see https://resend.com/docs/api-reference/suppressions/remove-suppression
     */
    public function remove(string $idOrEmail): \Resend\Suppression
    {
        $payload = Payload::delete('suppressions', $idOrEmail);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }
}
