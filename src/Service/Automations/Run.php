<?php

namespace Resend\Service\Automations;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Run extends Service
{
    /**
     * Retrieve a single automation run.
     *
     * @see https://resend.com/docs/api-reference/automations/get-automation-run
     */
    public function get(string $automationId, string $runId): \Resend\Automations\Run
    {
        $payload = Payload::get("automations/$automationId/runs", $runId);

        $result = $this->transporter->request($payload);

        return $this->createResource('automation-runs', $result);
    }

    /**
     * Retrieve a list of automation runs.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string, 'status'?: string} $options
     * @return \Resend\Collection<\Resend\Automations\Run>
     *
     * @see https://resend.com/docs/api-reference/automations/list-automation-runs
     */
    public function list(string $automationId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("automations/$automationId/runs", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('automation-runs', $result);
    }
}
