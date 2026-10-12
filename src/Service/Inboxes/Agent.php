<?php

namespace Resend\Service\Inboxes;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Agent extends Service
{
    /**
     * Retrieve the agent settings for an inbox.
     *
     * An inbox without a configured agent returns empty settings: `instructions`
     * and `tone` are null and `enabled_actions` is an empty array.
     *
     * @see https://resend.com/docs/api-reference/inboxes/get-agent
     */
    public function get(string $inboxId): \Resend\Inboxes\Agent
    {
        $payload = Payload::list("inboxes/{$inboxId}/agent");

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-agents', $result);
    }

    /**
     * Update the agent settings for an inbox.
     *
     * The agent is created when the inbox has none. Omitted fields keep their
     * current value. `enabled_actions` replaces the whole set.
     *
     * @param array{
     *     'instructions'?: string|null,
     *     'tone'?: string|null,
     *     'enabled_actions'?: array<int, 'draft_reply'|'forward_thread'|'add_labels'|'assign_thread'|'mark_as_spam'|'archive_thread'|'delete_thread'>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-agent
     */
    public function update(string $inboxId, array $parameters): \Resend\Inboxes\Agent
    {
        $payload = Payload::update('inboxes', "{$inboxId}/agent", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-agents', $result);
    }
}
