<?php

namespace Resend\Service\Inboxes;

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
        $payload = Payload::list("inboxes/{$inboxId}/drafts", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Create an unsent draft on an inbox.
     *
     * Omit `thread_id` and `reply_to_email_id` for a draft that starts a new
     * thread. Pass both together for a reply draft in an existing thread. Only
     * one unsent reply draft can target an email, so a second request for the
     * same email returns the ID of the existing draft. Each attachment needs
     * `content`, `filename` and `content_type`. A draft can carry up to 10
     * files and 25 MB in total. The response carries only `object` and `id`.
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
     *     'attachments'?: array<int, array{content: string, filename: string, content_type: string}>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/create-draft
     */
    public function create(string $inboxId, array $parameters): \Resend\Inboxes\Draft
    {
        $payload = Payload::create("inboxes/{$inboxId}/drafts", $parameters);

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
        $payload = Payload::get("inboxes/{$inboxId}/drafts", $draftId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Update the content of an unsent draft.
     *
     * Omitted fields are left unchanged. Setting `text` or `html` replaces the
     * whole body, so the body part you omit becomes `null`. Sending
     * `attachments` replaces every attachment on the draft. Send `[]` to
     * remove them all.
     *
     * @param array{
     *     'to'?: string|array<int, string>|null,
     *     'cc'?: string|array<int, string>|null,
     *     'bcc'?: string|array<int, string>|null,
     *     'subject'?: string|null,
     *     'html'?: string|null,
     *     'text'?: string|null,
     *     'attachments'?: array<int, array{content: string, filename: string, content_type: string}>
     * } $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-draft
     */
    public function update(string $inboxId, string $draftId, array $parameters): \Resend\Inboxes\Draft
    {
        $payload = Payload::update("inboxes/{$inboxId}/drafts", $draftId, $parameters);

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
        $payload = Payload::delete("inboxes/{$inboxId}/drafts", $draftId);

        $result = $this->transporter->request($payload);

        return $this->createResource('inbox-drafts', $result);
    }

    /**
     * Send a draft from the inbox address.
     *
     * A reply draft is sent in its thread. A draft without a thread starts a
     * new thread. The response carries only the `id` of the sent email.
     *
     * @see https://resend.com/docs/api-reference/inboxes/send-draft
     */
    public function send(string $inboxId, string $draftId): \Resend\Email
    {
        $payload = Payload::withAction("inboxes/{$inboxId}/drafts", $draftId, 'send');

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }
}
