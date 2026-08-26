<?php

namespace Resend\Service;

use InvalidArgumentException;
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

    /**
     * Create a shareable link for a sent or received email with the given ID.
     *
     * @param array{'expires_in'?: string} $parameters
     *
     * @see https://resend.com/docs/api-reference/emails/share-email
     */
    public function share(string $id, array $parameters = []): \Resend\Email
    {
        $payload = Payload::create("emails/{$id}/share", $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails', $result);
    }

    /**
     * Retrieve email delivery and engagement metrics.
     *
     * @param array{
     *     'start_date'?: string,
     *     'end_date'?: string,
     *     'timezone'?: string,
     *     'granularity'?: 'hourly'|'daily'|'weekly'|'monthly',
     *     'metrics'?: array<int, 'received'|'delivered'|'complained'|'suppressed'|'bounced'|'bounced_transient'|'bounced_permanent'|'bounced_undetermined'|'opened'|'clicked'|'unsubscribed'|'delivery_delayed'|'failed'|'sent'|'unique_opened'|'unique_clicked'|'delivery_rate'|'open_rate'|'click_rate'|'bounce_rate'|'complaint_rate'|'unsubscribe_rate'>,
     *     'dimensions'?: array<int, 'period'|'domain'|'email'|'broadcast'>,
     *     'domain_id'?: array<int, string>,
     *     'email_id'?: array<int, string>,
     *     'broadcast_id'?: array<int, string>
     * } $options
     *
     * @see https://resend.com/docs/api-reference/emails/get-metrics
     */
    public function metrics(array $options = []): \Resend\Metrics
    {
        $dimensions = $options['dimensions'] ?? [];
        $hasEmail = in_array('email', $dimensions, true) || ! empty($options['email_id']);
        $hasBroadcast = in_array('broadcast', $dimensions, true) || ! empty($options['broadcast_id']);

        if ($hasEmail && $hasBroadcast) {
            throw new InvalidArgumentException('The `broadcast` dimension/`broadcast_id` filter cannot be combined with the `email` dimension/`email_id` filter.');
        }

        $queryParams = [];

        foreach (['start_date', 'end_date', 'timezone', 'granularity'] as $key) {
            if (isset($options[$key]) && $options[$key] !== '') {
                $queryParams[$key] = $options[$key];
            }
        }

        foreach (['metrics', 'dimensions', 'domain_id', 'email_id', 'broadcast_id'] as $key) {
            if (! empty($options[$key])) {
                $queryParams[$key] = implode(',', $options[$key]);
            }
        }

        $resource = 'emails/metrics' . ($queryParams !== [] ? '?' . http_build_query($queryParams) : '');

        $payload = Payload::list($resource);

        $result = $this->transporter->request($payload);

        return $this->createResource('emails-metrics', $result, asList: false);
    }
}
