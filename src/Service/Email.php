<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Email extends Service
{
    /**
     * Retrieve an email with the given ID.
     *
     * @see https://resend.com/docs/api-reference/emails/retrieve-email#path-parameters
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
     * @see https://resend.com/docs/api-reference/emails/send-email#body-parameters
     */
    public function create(array $parameters): \Resend\Email
    {
        $payload = Payload::create('emails', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Send an email with the given parameters.
     *
     * @see https://resend.com/docs/api-reference/emails/send-email#body-parameters
     */
    public function send(array $parameters): \Resend\Email
    {
        return $this->create($parameters);
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
