<?php

namespace Resend\Service\Inboxes\Threads;

use Resend\Service\Inbox;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Label extends Service
{
    /**
     * Add labels to a thread.
     *
     * Labels already on the thread stay on it. A label ID that is not a label
     * of the inbox returns a 404, and nothing changes. To replace the labels
     * of the thread, use `set`.
     *
     * @param array{labels: array<int, string>} $parameters Between 1 and 10 label IDs.
     * @return \Resend\Collection<\Resend\Inboxes\Label> Every label on the thread after the change.
     *
     * @see https://resend.com/docs/api-reference/inboxes/add-thread-labels
     */
    public function add(string $inboxId, string $threadId, array $parameters): \Resend\Collection
    {
        $payload = Payload::create(self::path($inboxId, $threadId), $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    /**
     * Replace every label on a thread with the given labels, in one atomic change.
     *
     * The labels themselves are kept. An empty array takes every label off the
     * thread. A label ID that is not a label of the inbox returns a 404, and
     * nothing changes.
     *
     * @param array{labels: array<int, string>} $parameters Up to 100 label IDs.
     * @return \Resend\Collection<\Resend\Inboxes\Label> Every label on the thread after the change.
     *
     * @see https://resend.com/docs/api-reference/inboxes/set-thread-labels
     */
    public function set(string $inboxId, string $threadId, array $parameters): \Resend\Collection
    {
        $payload = Payload::replace(self::path($inboxId, $threadId), $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    /**
     * Take one label off a thread.
     *
     * The label itself is kept, and stays on every other thread that carries
     * it. A label that is not on the thread returns the current labels. To
     * delete the label, use `$resend->inboxes->labels->remove`.
     *
     * @return \Resend\Collection<\Resend\Inboxes\Label> Every label on the thread after the change.
     *
     * @see https://resend.com/docs/api-reference/inboxes/remove-thread-label
     */
    public function remove(string $inboxId, string $threadId, string $labelId): \Resend\Collection
    {
        $payload = Payload::delete(self::path($inboxId, $threadId), $labelId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-labels', $result);
    }

    private static function path(string $inboxId, string $threadId): string
    {
        return Inbox::path($inboxId) . "/threads/{$threadId}/labels";
    }
}
