<?php

namespace Resend\Service;

use Resend\ValueObjects\Transporter\Payload;

class Log extends Service
{
    /**
     * Retrieve a log with the given ID.
     *
     * @see https://resend.com/docs/api-reference/logs/retrieve-log
     */
    public function get(string $logId): \Resend\Log
    {
        $payload = Payload::get('logs', $logId);

        $result = $this->transporter->request($payload);

        return $this->createResource('logs', $result);
    }

    /**
     * List all logs.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Log>
     *
     * @see https://resend.com/docs/api-reference/logs/list-logs
     */
    public function list(array $options = []): \Resend\Collection
    {
        $payload = Payload::list('logs', $options);

        $result = $this->transporter->request($payload);

        return $this->createResource('logs', $result);
    }
}
