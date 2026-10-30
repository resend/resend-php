<?php

namespace Resend\Service\Inboxes;

use Resend\Service\Inbox;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Draft extends Service
{
    /**
     * List the unsent drafts on an inbox, most recently updated first.
     *
     * The `after` and `before` cursors take a Draft ID from the current page.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Inboxes\Draft>
     *
     * @see https://resend.com/docs/api-reference/inboxes/list-drafts
     */
    public function list(string $inboxId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list(Inbox::path($inboxId) . '/drafts', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Create an unsent draft on an inbox.
     *
     * Omit `thread_id` and `reply_to_email_id` for a draft that starts a new
     * thread. Pass both together for a reply draft in an existing thread. Only
     * one unsent reply draft can target an email, so a second request for the
     * same email returns the ID of the existing draft. That request ignores
     * every other field, except `attachments`, which replaces the attachments
     * of the existing draft. A reply draft created without `subject` stores an
     * empty subject, so set one before you send it. Each attachment needs a
     * `filename` and either `content` with a `content_type`, or a `path` URL
     * that is downloaded when the request is made. With `path`, `content_type`
     * defaults to the type of the downloaded file. The files on a draft,
     * downloaded ones included, can total at most 25 MB. A `path` that cannot
     * be downloaded returns a 422. The response carries only `object` and `id`.
     *
     * Pass `idempotency_key` in `$options` to send the request only once. A
     * retry with the same key within 24 hours returns the first successful
     * response. A failed request is not stored, so you can retry it with the
     * same key. Reusing the key with a different body, or while the first
     * request is still running, returns a 409.
     *
     * @param array{
     *     'to'?: string|array<int, string>|null,
     *     'cc'?: string|array<int, string>|null,
     *     'bcc'?: string|array<int, string>|null,
     *     'subject'?: string|null,
     *     'html'?: string|null,
     *     'text'?: string|null,
     *     'thread_id'?: string,
     *     'reply_to_email_id'?: string,
     *     'attachments'?: array<int, array{content: string, filename: string, content_type: string}|array{path: string, filename: string, content_type?: string}>
     * } $parameters
     * @param array{'idempotency_key'?: string} $options
     *
     * @see https://resend.com/docs/api-reference/inboxes/create-draft
     */
    public function create(string $inboxId, array $parameters, array $options = []): \Resend\Inboxes\Draft
    {
        $payload = Payload::create(Inbox::path($inboxId) . '/drafts', $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Retrieve a single draft.
     *
     * @see https://resend.com/docs/api-reference/inboxes/get-draft
     */
    public function get(string $inboxId, string $draftId): \Resend\Inboxes\Draft
    {
        $payload = Payload::get(Inbox::path($inboxId) . '/drafts', $draftId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Update the content of an unsent draft.
     *
     * Omitted fields are left unchanged. Setting `text` or `html` replaces the
     * whole body, so the body part you omit becomes `null`. Sending
     * `attachments` replaces every attachment on the draft, with the same rules
     * as create(). Send `[]` or `null` to remove them all. The response carries
     * only `object` and `id`.
     *
     * @param array{
     *     'to'?: string|array<int, string>|null,
     *     'cc'?: string|array<int, string>|null,
     *     'bcc'?: string|array<int, string>|null,
     *     'subject'?: string|null,
     *     'html'?: string|null,
     *     'text'?: string|null,
     *     'attachments'?: array<int, array{content: string, filename: string, content_type: string}|array{path: string, filename: string, content_type?: string}>|null
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-draft
     */
    public function update(string $inboxId, string $draftId, array $parameters): \Resend\Inboxes\Draft
    {
        $payload = Payload::update(Inbox::path($inboxId) . '/drafts', $draftId, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Discard an unsent draft.
     *
     * @see https://resend.com/docs/api-reference/inboxes/delete-draft
     */
    public function remove(string $inboxId, string $draftId): \Resend\Inboxes\Draft
    {
        $payload = Payload::delete(Inbox::path($inboxId) . '/drafts', $draftId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Send a draft from the inbox address.
     *
     * A reply draft is sent in its thread. A draft without a thread starts a
     * new thread. The draft must have at least one `to` recipient, a non-empty
     * `subject`, and `html` or `text`, or the request returns a 422. The
     * response carries only the `id` of the sent email.
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
     * @param array{'headers'?: array<string, string>} $parameters
     * @param array{'idempotency_key'?: string} $options
     *
     * @see https://resend.com/docs/api-reference/inboxes/send-draft
     */
    public function send(string $inboxId, string $draftId, array $parameters = [], array $options = []): \Resend\Email
    {
        $payload = Payload::create(Inbox::path($inboxId) . "/drafts/{$draftId}/send", $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }
}
