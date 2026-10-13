<?php

namespace Resend\Service\Inboxes;

use Resend\Contracts\Transporter;
use Resend\Service\Inboxes\Threads\Email;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Thread extends Service
{
    public Email $emails;

    /**
     * Create a new inbox thread service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->emails = new Email($transporter);

        parent::__construct($transporter);
    }

    /**
     * List the threads in an inbox, most recently active first.
     *
     * `folders` defaults to `inbox`, or to `inbox,archive,sent` when `labels`
     * is set. Only one of `after` or `before` can be passed.
     *
     * @param array{
     *     'folders'?: array<int, 'inbox'|'archive'|'spam'|'sent'|'trash'>,
     *     'labels'?: array<int, string>,
     *     'read'?: bool,
     *     'limit'?: int,
     *     'before'?: string,
     *     'after'?: string
     * } $options
     * @return \Resend\Collection<\Resend\Inboxes\Thread>
     *
     * @see https://resend.com/docs/api-reference/inboxes/list-threads
     */
    public function list(string $inboxId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list(
            "inboxes/{$inboxId}/threads",
            $this->toQuery($options),
            ['folders', 'labels', 'read']
        );

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Search the threads of an inbox.
     *
     * Different parameters combine, so a thread must match all of them.
     * `query`, `from`, `to`, `cc`, `bcc`, `has_attachment`, `start_date`, and
     * `end_date` must all match the same email in the thread. Search can be
     * up to about a minute behind new emails.
     *
     * @param array{
     *     'query'?: string,
     *     'from'?: array<int, string>,
     *     'to'?: array<int, string>,
     *     'cc'?: array<int, string>,
     *     'bcc'?: array<int, string>,
     *     'has_attachment'?: bool,
     *     'start_date'?: string,
     *     'end_date'?: string,
     *     'folders'?: array<int, 'inbox'|'archive'|'spam'|'sent'|'trash'>,
     *     'labels'?: array<int, string>,
     *     'read'?: bool,
     *     'limit'?: int,
     *     'before'?: string,
     *     'after'?: string
     * } $options
     * @return \Resend\Collection<\Resend\Inboxes\Thread>
     *
     * @see https://resend.com/docs/api-reference/inboxes/search-threads
     */
    public function search(string $inboxId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list(
            "inboxes/{$inboxId}/threads/search",
            $this->toQuery($options),
            ['query', 'from', 'to', 'cc', 'bcc', 'has_attachment', 'start_date', 'end_date', 'folders', 'labels', 'read']
        );

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Retrieve the summary of a single thread.
     *
     * @see https://resend.com/docs/api-reference/inboxes/get-thread
     */
    public function get(string $inboxId, string $threadId): \Resend\Inboxes\Thread
    {
        $payload = Payload::get("inboxes/{$inboxId}/threads", $threadId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Mark a thread read or unread, move it to a folder, or add and remove labels.
     *
     * At least one of `read`, `folder`, `add_label_ids`, or `remove_label_ids`
     * is required. A label ID cannot be both added and removed in the same
     * request. Removing a label from a thread keeps the label itself. Moving a
     * thread out of `trash` restores it and clears its deletion deadline.
     *
     * @param array{
     *     'read'?: bool,
     *     'folder'?: 'inbox'|'archive'|'spam'|'trash',
     *     'add_label_ids'?: array<int, string>,
     *     'remove_label_ids'?: array<int, string>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-thread
     */
    public function update(string $inboxId, string $threadId, array $parameters): \Resend\Inboxes\Thread
    {
        $payload = Payload::update("inboxes/{$inboxId}/threads", $threadId, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Move a thread to `trash` and schedule it for deletion in 30 days.
     *
     * This is reversible. To restore the thread, update its `folder` to
     * `inbox`, `archive`, or `spam`.
     *
     * @see https://resend.com/docs/api-reference/inboxes/delete-thread
     */
    public function remove(string $inboxId, string $threadId): \Resend\Inboxes\Thread
    {
        $payload = Payload::delete("inboxes/{$inboxId}/threads", $threadId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Send list values as comma-separated strings and booleans as `true` or `false`.
     */
    private function toQuery(array $options): array
    {
        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $options[$key] = implode(',', $value);
            } elseif (is_bool($value)) {
                $options[$key] = $value ? 'true' : 'false';
            }
        }

        return $options;
    }
}
