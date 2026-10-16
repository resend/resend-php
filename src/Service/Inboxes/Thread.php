<?php

namespace Resend\Service\Inboxes;

use Resend\Contracts\Transporter;
use Resend\Service\Inbox;
use Resend\Service\Inboxes\Threads\Email;
use Resend\Service\Inboxes\Threads\Label;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Thread extends Service
{
    public Email $emails;

    public Label $labels;

    /**
     * Create a new inbox thread service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->emails = new Email($transporter);
        $this->labels = new Label($transporter);

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
            Inbox::path($inboxId) . '/threads',
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
            Inbox::path($inboxId) . '/threads/search',
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
        $payload = Payload::get(Inbox::path($inboxId) . '/threads', $threadId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-threads', $result);
    }

    /**
     * Mark a thread read or unread, or move it to a folder.
     *
     * At least one of `read` or `folder` is required. To change the labels of
     * a thread, use `$resend->inboxes->threads->labels`. Moving a thread out
     * of `trash` restores it and clears its deletion deadline. The changes
     * apply in this order: `read`, then `folder`. They are not atomic.
     *
     * @param array{
     *     'read'?: bool,
     *     'folder'?: 'inbox'|'archive'|'spam'|'trash'
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-thread
     */
    public function update(string $inboxId, string $threadId, array $parameters): \Resend\Inboxes\Thread
    {
        $payload = Payload::update(Inbox::path($inboxId) . '/threads', $threadId, $parameters);

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
        $payload = Payload::delete(Inbox::path($inboxId) . '/threads', $threadId);

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
