<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Inboxes\Agent;
use Resend\Service\Inboxes\Draft;
use Resend\Service\Inboxes\Label;
use Resend\Service\Inboxes\Thread;
use Resend\ValueObjects\Transporter\Payload;

class Inbox extends Service
{
    public Agent $agent;

    public Draft $drafts;

    public Label $labels;

    public Thread $threads;

    /**
     * Create a new inbox service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->agent = new Agent($transporter);
        $this->drafts = new Draft($transporter);
        $this->labels = new Label($transporter);
        $this->threads = new Thread($transporter);

        parent::__construct($transporter);
    }

    /**
     * Create an inbox that sends and receives email at an address on one of your domains.
     *
     * The response carries only `object` and `id`. A team that has reached
     * the inbox limit of its plan returns a 403 validation_error.
     *
     * @param array{email_address: string, name?: string, from_name?: string, forwarding?: bool} $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/create-inbox
     */
    public function create(array $parameters): \Resend\Inbox
    {
        $payload = Payload::create('inboxes', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inboxes', $result);
    }

    /**
     * List the inboxes of the team, newest first.
     *
     * The list items carry fewer fields than a single inbox.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Inbox>
     *
     * @see https://resend.com/docs/api-reference/inboxes/list-inboxes
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('inboxes', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('inboxes', $result);
    }

    /**
     * Retrieve a single inbox by ID or email address.
     *
     * @see https://resend.com/docs/api-reference/inboxes/get-inbox
     */
    public function get(string $idOrEmail): \Resend\Inbox
    {
        $payload = Payload::get('inboxes', rawurlencode($idOrEmail));

        $result = $this->transporter->request($payload);

        return $this->createResource('inboxes', $result);
    }

    /**
     * Update the internal name of an inbox or the name recipients see when mail is sent from it.
     *
     * At least one of `name` or `from_name` is required. The inbox can be
     * given by ID or email address.
     *
     * @param array{name?: string, from_name?: string} $parameters
     *
     * @see https://resend.com/docs/api-reference/inboxes/update-inbox
     */
    public function update(string $idOrEmail, array $parameters): \Resend\Inbox
    {
        $payload = Payload::update('inboxes', rawurlencode($idOrEmail), $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('inboxes', $result);
    }

    /**
     * Remove an inbox by ID or email address.
     *
     * @see https://resend.com/docs/api-reference/inboxes/delete-inbox
     */
    public function remove(string $idOrEmail): \Resend\Inbox
    {
        $payload = Payload::delete('inboxes', rawurlencode($idOrEmail));

        $result = $this->transporter->request($payload);

        return $this->createResource('inboxes', $result);
    }

    /**
     * The path of an inbox. The API takes the inbox ID or the inbox email
     * address, and an address must be percent-encoded to fit in the path.
     */
    public static function path(string $idOrEmail): string
    {
        return 'inboxes/' . rawurlencode($idOrEmail);
    }
}
