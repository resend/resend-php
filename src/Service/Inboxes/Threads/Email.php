<?php

namespace Resend\Service\Inboxes\Threads;

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
        $payload = Payload::list("inboxes/{$inboxId}/threads/{$threadId}/emails", $options);

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
        $payload = Payload::get("inboxes/{$inboxId}/threads/{$threadId}/emails", $emailId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-thread-emails', $result);
    }

    /**
     * Reply to a thread email from the inbox address right away, with no stored draft.
     *
     * The `to` recipients come from the message you reply to. Set `reply_all`
     * to also copy the other recipients of the message. The response carries
     * only the `id` of the sent email.
     *
     * @param array{
     *     'html'?: string,
     *     'text'?: string,
     *     'subject'?: string,
     *     'cc'?: string|array<int, string>,
     *     'bcc'?: string|array<int, string>,
     *     'reply_all'?: bool,
     *     'attachments'?: array<int, array{content?: string, path?: string, filename?: string, content_type?: string, content_id?: string}>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/reply-thread-email
     */
    public function reply(string $inboxId, string $threadId, string $emailId, array $parameters): \Resend\Email
    {
        $payload = Payload::create("inboxes/{$inboxId}/threads/{$threadId}/emails/{$emailId}/reply", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Forward a thread email from the inbox address right away, with no stored draft.
     *
     * The attachments of the original message are sent with the forward,
     * together with any `attachments` you add. The response carries only the
     * `id` of the sent email.
     *
     * @param array{
     *     to: string|array<int, string>,
     *     'cc'?: string|array<int, string>,
     *     'bcc'?: string|array<int, string>,
     *     'html'?: string,
     *     'text'?: string,
     *     'subject'?: string,
     *     'attachments'?: array<int, array{content?: string, path?: string, filename?: string, content_type?: string, content_id?: string}>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/forward-thread-email
     */
    public function forward(string $inboxId, string $threadId, string $emailId, array $parameters): \Resend\Email
    {
        $payload = Payload::create("inboxes/{$inboxId}/threads/{$threadId}/emails/{$emailId}/forward", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }
}
