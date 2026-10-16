<?php

namespace Resend\Service\Inboxes\Threads;

use Resend\Service\Inbox;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Email extends Service
{
    /**
     * List the messages of a thread, oldest first.
     *
     * Pass the `id` of the last message as `after` to get the next, newer
     * page, or the `id` of the first message as `before` to get the previous,
     * older page. You cannot combine `after` and `before`.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Inboxes\Threads\Email>
     *
     * @see https://resend.com/docs/api-reference/inboxes/list-thread-emails
     */
    public function list(string $inboxId, string $threadId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list(Inbox::path($inboxId) . "/threads/{$threadId}/emails", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-thread-emails', $result);
    }

    /**
     * Retrieve a single message of a thread.
     *
     * @see https://resend.com/docs/api-reference/inboxes/get-thread-email
     */
    public function get(string $inboxId, string $threadId, string $emailId): \Resend\Inboxes\Threads\Email
    {
        $payload = Payload::get(Inbox::path($inboxId) . "/threads/{$threadId}/emails", $emailId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-thread-emails', $result);
    }

    /**
     * Reply to a thread email from the inbox address right away, with no stored draft.
     *
     * The `to` recipients come from the message you reply to. Set `reply_all`
     * to also copy the other recipients of the message. An empty file, a
     * blocked file type, or an attachment `path` that is not an `http` or
     * `https` URL returns a 422. The response carries only the `id` of the
     * sent email.
     *
     * `headers` adds custom headers. The `In-Reply-To`, `References` and
     * `Reply-To` headers are set by Resend and cannot be set here. Sending one
     * of them, in any letter case, returns a 422. Header names cannot be
     * empty, and names and values cannot contain line breaks or null
     * characters.
     *
     * Pass `idempotency_key` in `$options` to send the request only once. A
     * retry with the same key within 24 hours returns the first successful
     * response. A failed request is not stored, so you can retry it with the
     * same key. Reusing the key with a different body, or while the first
     * request is still running, returns a 409.
     *
     * @param array{
     *     'html'?: string,
     *     'text'?: string,
     *     'subject'?: string,
     *     'cc'?: string|array<int, string>,
     *     'bcc'?: string|array<int, string>,
     *     'reply_all'?: bool,
     *     'attachments'?: array<int, array{content?: string, path?: string, filename?: string, content_type?: string, content_id?: string}>,
     *     'headers'?: array<string, string>
     * } $parameters
     * @param array{'idempotency_key'?: string} $options
     *
     * @see https://resend.com/docs/api-reference/inboxes/reply-thread-email
     */
    public function reply(string $inboxId, string $threadId, string $emailId, array $parameters, array $options = []): \Resend\Email
    {
        $payload = Payload::create(Inbox::path($inboxId) . "/threads/{$threadId}/emails/{$emailId}/reply", $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Forward a thread email from the inbox address right away, with no stored draft.
     *
     * The attachments of the original message are sent with the forward,
     * together with any `attachments` you add. An empty file, a blocked file
     * type, or a `path` that is not an `http` or `https` URL returns a 422.
     * An original attachment that was
     * sent from a URL (`path`) cannot be forwarded, and the request returns a
     * 422. The response carries only the `id` of the sent email.
     *
     * `headers` adds custom headers. The `In-Reply-To`, `References` and
     * `Reply-To` headers are set by Resend and cannot be set here. Sending one
     * of them, in any letter case, returns a 422. Header names cannot be
     * empty, and names and values cannot contain line breaks or null
     * characters.
     *
     * Pass `idempotency_key` in `$options` to send the request only once. A
     * retry with the same key within 24 hours returns the first successful
     * response. A failed request is not stored, so you can retry it with the
     * same key. Reusing the key with a different body, or while the first
     * request is still running, returns a 409.
     *
     * @param array{
     *     to: string|array<int, string>,
     *     'cc'?: string|array<int, string>,
     *     'bcc'?: string|array<int, string>,
     *     'html'?: string,
     *     'text'?: string,
     *     'subject'?: string,
     *     'attachments'?: array<int, array{content?: string, path?: string, filename?: string, content_type?: string, content_id?: string}>,
     *     'headers'?: array<string, string>
     * } $parameters
     * @param array{'idempotency_key'?: string} $options
     *
     * @see https://resend.com/docs/api-reference/inboxes/forward-thread-email
     */
    public function forward(string $inboxId, string $threadId, string $emailId, array $parameters, array $options = []): \Resend\Email
    {
        $payload = Payload::create(Inbox::path($inboxId) . "/threads/{$threadId}/emails/{$emailId}/forward", $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }
}
