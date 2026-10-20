<?php

namespace Resend\Service\Inboxes;

use Resend\Service\Inbox;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Label extends Service
{
    /**
     * List every label on an inbox, oldest first. The list is not paginated.
     *
     * @return \Resend\Collection<\Resend\Inboxes\Label>
     *
     * @see https://resend.com/docs/api-reference/inboxes/list-labels
     */
    public function list(string $inboxId): \Resend\Collection
    {
        $payload = Payload::list(Inbox::path($inboxId) . '/labels');

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    /**
     * Create a label on an inbox.
     *
     * The response carries only `object` and `id`. Label names are unique per
     * inbox, compared without case. When `color` is omitted, a random color
     * from the dashboard palette is used.
     *
     * @param array{name: string, color?: string} $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/create-label
     */
    public function create(string $inboxId, array $parameters): \Resend\Inboxes\Label
    {
        $payload = Payload::create(Inbox::path($inboxId) . '/labels', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    /**
     * Rename or recolor a label. Omitted fields keep their current value.
     *
     * @param array{name?: string, color?: string} $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-label
     */
    public function update(string $inboxId, string $labelId, array $parameters): \Resend\Inboxes\Label
    {
        $payload = Payload::update(Inbox::path($inboxId) . '/labels', $labelId, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    /**
     * Delete a label and remove it from every thread that carries it.
     *
     * @see https://resend.com/docs/api-reference/inboxes/delete-label
     */
    public function remove(string $inboxId, string $labelId): \Resend\Inboxes\Label
    {
        $payload = Payload::delete(Inbox::path($inboxId) . '/labels', $labelId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }
}
