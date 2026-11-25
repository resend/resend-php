<?php

namespace Resend\Service\Emails;

use Resend\Contracts\Transporter;
use Resend\Service\Emails\Receiving\Attachment;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Receiving extends Service
{
    public Attachment $attachments;

    /**
     * Create a new email receiving service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->attachments = new Attachment($transporter);

        parent::__construct($transporter);
    }

    /**
     * Retrieve an inbound email with the given ID.
     *
     * @see https://resend.com/docs/api-reference/emails/retrieve-inbound-email
     */
    public function get(string $id): \Resend\Emails\Receiving
    {
        $payload = Payload::get('emails/receiving', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('receiving', $result);
    }

    /**
     * List all inbound emails.
     *
     * `to` matches the envelope recipient exactly (case-sensitive) and returns
     * emails received by any of up to 20 addresses. `start_date` and `end_date`
     * take an ISO 8601 date or datetime, read as UTC without an offset. Both
     * are inclusive, and a bare `end_date` covers that whole day.
     *
     * @param array{
     *     'to'?: array<int, string>,
     *     'start_date'?: string,
     *     'end_date'?: string,
     *     'limit'?: int,
     *     'before'?: string,
     *     'after'?: string
     * } $options
     * @return \Resend\Collection<\Resend\Emails\Receiving>
     *
     * @see https://resend.com/docs/api-reference/emails/list-inbound-emails
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('emails/receiving', $this->toQuery($options), ['to', 'start_date', 'end_date']);

        $result = $this->transporter->request($payload);

        return $this->createResource('receiving', $result);
    }
}
