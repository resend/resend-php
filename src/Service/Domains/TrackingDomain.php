<?php

namespace Resend\Service\Domains;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class TrackingDomain extends Service
{
    /**
     * Retrieve a single click tracking domain.
     *
     * @see https://resend.com/docs/api-reference/domains/get-tracking-domain
     */
    public function get(string $domainId, string $trackingDomainId): \Resend\Domains\TrackingDomain
    {
        $payload = Payload::get("domains/$domainId/tracking-domains", $trackingDomainId);

        $result = $this->transporter->request($payload);

        return $this->createResource('tracking-domains', $result);
    }

    /**
     * Create a custom domain for click and open tracking.
     *
     * @param array{'subdomain': string} $parameters
     * @see https://resend.com/docs/api-reference/domains/create-tracking-domain
     */
    public function create(string $domainId, array $parameters): \Resend\Domains\TrackingDomain
    {
        $payload = Payload::create("domains/$domainId/tracking-domains", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('tracking-domains', $result);
    }

    /**
     * List all tracking domains for a given domain.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Domains\TrackingDomain>
     *
     * @see https://resend.com/docs/api-reference/domains/list-tracking-domains
     */
    public function list(string $domainId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("domains/$domainId/tracking-domains", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('tracking-domains', $result);
    }

    /**
     * Remove an existing click tracking domain.
     *
     * @see https://resend.com/docs/api-reference/domains/delete-tracking-domain
     */
    public function remove(string $domainId, string $trackingDomainId): \Resend\Domains\TrackingDomain
    {
        $payload = Payload::delete("domains/$domainId/tracking-domains", $trackingDomainId);

        $result = $this->transporter->request($payload);

        return $this->createResource('tracking-domains', $result);
    }

    /**
     * Verify an existing tracking domain.
     *
     * @see https://resend.com/docs/api-reference/domains/verify-tracking-domain
     */
    public function verify(string $domainId, string $trackingDomainId): \Resend\Domains\TrackingDomain
    {
        $payload = Payload::verify("domains/$domainId/tracking-domains", $trackingDomainId);

        $result = $this->transporter->request($payload);

        return $this->createResource('tracking-domains', $result);
    }
}
