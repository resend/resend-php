<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Automations\Run;
use Resend\ValueObjects\Transporter\Payload;

class Automation extends Service
{
    public Run $runs;

    /**
     * Create a new automation service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->runs = new Run($transporter);

        parent::__construct($transporter);
    }

    /**
     * Retrieve a single automation.
     *
     * @see https://resend.com/docs/api-reference/automations/get-automation
     */
    public function get(string $automationId): \Resend\Automation
    {
        $payload = Payload::get('automations', $automationId);

        $result = $this->transporter->request($payload);

        return $this->createResource('automations', $result);
    }

    /**
     * Create a new automation to automate email sequences.
     *
     * @see https://resend.com/docs/api-reference/automations/create-automation
     */
    public function create(array $parameters): \Resend\Automation
    {
        $payload = Payload::create('automations', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('automations', $result);
    }

    /**
     * Retrieve a list of automations.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Automation>
     *
     * @see https://resend.com/docs/api-reference/automations/list-automations
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('automations', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('automations', $result);
    }

    /**
     * Update an existing automation.
     *
     * @see https://resend.com/docs/api-reference/automations/update-automation
     */
    public function update(string $automationId, array $parameters): \Resend\Automation
    {
        $payload = Payload::update('automations', $automationId, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('automations', $result);
    }

    /**
     * Remove an existing automation.
     *
     * @see https://resend.com/docs/api-reference/automations/delete-automation
     */
    public function remove(string $automationId): \Resend\Automation
    {
        $payload = Payload::delete('automations', $automationId);

        $result = $this->transporter->request($payload);

        return $this->createResource('automations', $result);
    }
}
