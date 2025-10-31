<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Topic extends Service
{
    /**
     * Retrieve a topic with the given ID.
     *
     * @see https://resend.com/docs/api-reference/topics/get-topic
     */
    public function get(string $id): \Resend\Topic
    {
        $payload = Payload::get('topics', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('topics', $result);
    }

    /**
     * Create a topic to segment your audience.
     *
     * @see https://resend.com/docs/api-reference/topics/create-topic
     */
    public function create(array $parameters, array $options = []): \Resend\Topic
    {
        $payload = Payload::create('topics', $parameters, $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('topics', $result);
    }

    /**
     * Retrieve a list of topics.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Topic>
     *
     * @see https://resend.com/docs/api-reference/topics/list-topics
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('topics', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('topics', $result);
    }

    /**
     * Update an existing topic.
     *
     * @see https://resend.com/docs/api-reference/topics/update-topic
     */
    public function update(string $id, array $parameters): \Resend\Topic
    {
        $payload = Payload::update('topics', $id, $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('topics', $result);
    }

    /**
     * Remove an existing topic.
     *
     * @see https://resend.com/docs/api-reference/topics/delete-topic
     */
    public function remove(string $id): \Resend\Topic
    {
        $payload = Payload::delete('topics', $id);

        $result = $this->transporter->request($payload);

        return $this->createResource('topics', $result);
    }
}
