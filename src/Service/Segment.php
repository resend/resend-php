<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Segment extends Service
{
    /**
     * Retrieve a segment with the given ID.
     *
     * @see https://resend.com/docs/api-reference/segments/get-segment
     */
    public function get(string $id): \Resend\Segment
    {
        $payload = Payload::get('segments', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }

    /**
     * Create a new segment.
     *
     * @see https://resend.com/docs/api-reference/segments/create-segment
     */
    public function create(array $parameters): \Resend\Segment
    {
        $payload = Payload::create('segments', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }

    /**
     * List all segments.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Segment>
     *
     * @see https://resend.com/docs/api-reference/segments/list-segments
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('segments', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }

    /**
     * Remove a segment with the given ID.
     *
     * @see https://resend.com/docs/api-reference/segments/delete-segment#path-parameters
     */
    public function remove(string $id): \Resend\Segment
    {
        $payload = Payload::delete('segments', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('segments', $result);
    }
}
