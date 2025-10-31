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
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Emails\Receiving>
     *
     * @see https://resend.com/docs/api-reference/emails/list-inbound-emails
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('emails/receiving', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('receiving', $result);
    }
}
