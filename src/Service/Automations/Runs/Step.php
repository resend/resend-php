<?php

namespace Resend\Service\Automations\Runs;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Step extends Service
{
    /**
     * Retrieve a single automation run step.
     *
     * @see https://resend.com/docs/api-reference/automations/get-automation-run-step
     */
    public function get(string $automationId, string $runId, string $stepId): \Resend\Automations\Runs\Step
    {
        $payload = Payload::get("automations/$automationId/runs/$runId/steps", $stepId);

        $result = $this->transporter->request($payload);

        return $this->createResource('automation-run-steps', $result);
    }

    /**
     * Retrieve a list of automation run steps.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Automations\Runs\Step>
     *
     * @see https://resend.com/docs/api-reference/automations/list-automation-runs
     */
    public function list(string $automationId, string $runId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("automations/$automationId/runs/$runId/steps", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('automation-run-steps', $result);
    }
}
