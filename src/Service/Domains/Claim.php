<?php

namespace Resend\Service\Domains;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Claim extends Service
{
    /**
     * Retrieve the latest claim for a domain.
     *
     * @see https://resend.com/docs/api-reference/domains/get-domain-claim
     */
    public function get(string $id): \Resend\Domains\Claim
    {
        $payload = Payload::get("domains/{$id}", 'claims');

        $result = $this->transporter->request($payload);

        return $this->createResource('domain-claims', $result);
    }

    /**
     * Claim a domain that is already verified by another team.
     *
     * @param array{
     *     name: string,
     *     region?: string,
     *     custom_return_path?: string,
     *     open_tracking?: bool,
     *     click_tracking?: bool,
     *     tracking_subdomain?: string
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/domains/claim-domain
     */
    public function create(array $parameters): \Resend\Domains\Claim
    {
        $payload = Payload::create('domains/claims', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('domain-claims', $result);
    }

    /**
     * Trigger DNS verification for a domain claim.
     *
     * @see https://resend.com/docs/api-reference/domains/verify-domain-claim
     */
    public function verify(string $id): \Resend\Domains\Claim
    {
        $payload = Payload::verify("domains/{$id}", 'claims');

        $result = $this->transporter->request($payload);

        return $this->createResource('domain-claims', $result);
    }
}
