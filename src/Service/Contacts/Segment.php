<?php

namespace Resend\Service\Contacts;

use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Segment extends Service
{
    public function add(string $contact, string $segmentId): \Resend\Segment
    {
        $payload = Payload::create("contacts/$contact/segments/$segmentId", []);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }

    /**
     * Retrieve a list of segments for the given contact ID.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Segment>
     *
     * @see https://resend.com/docs/api-reference/contacts/list-contact-segments
     */
    public function list(string $contactId, array $options = []): \Resend\Collection
    {
        $payload = Payload::list("contacts/$contactId/segments", $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }

    public function remove(string $contact, string $segmentId): \Resend\Segment
    {
        $payload = Payload::delete("contacts/$contact/segments", $segmentId);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }
}
