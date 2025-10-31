<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Emails\Attachment;
use Resend\Service\Emails\Receiving;
use Resend\ValueObjects\Transporter\Payload;

class Email extends Service
{
    public Attachment $attachments;

    public Receiving $receiving;

    /**
     * Create a new email service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->attachments = new Attachment($transporter);
        $this->receiving = new Receiving($transporter);

        parent::__construct($transporter);
    }

    /**
     * Retrieve an email with the given ID.
     *
     * @see https://resend.com/docs/api-reference/emails/retrieve-email
     */
    public function get(string $id): \Resend\Email
    {
        $payload = Payload::get('emails', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Send an email with the given parameters.
     *
     * @see https://resend.com/docs/api-reference/emails/send-email
     */
    public function create(array $parameters, array $options = []): \Resend\Email
    {
        $payload = Payload::create('emails', $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Send an email with the given parameters.
     *
     * @see https://resend.com/docs/api-reference/emails/send-email
     */
    public function send(array $parameters, array $options = []): \Resend\Email
    {
        return $this->create($parameters, $options);
    }

    /**
     * List all emails.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     *
     * @see https://resend.com/docs/api-reference/emails/list-emails
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('emails', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Update a scheduled email with the given ID.
     *
     * @see https://resend.com/docs/api-reference/emails/update-email
     */
    public function update(string $id, array $parameters): \Resend\Email
    {
        $payload = Payload::update('emails', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Cancel a scheduled email with the given ID.
     *
     * @see https://resend.com/docs/api-reference/emails/cancel-email
     */
    public function cancel(string $id): \Resend\Email
    {
        $payload = Payload::cancel('emails', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }
}
