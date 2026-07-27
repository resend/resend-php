<?php

namespace Resend\Service\Suppressions;

use InvalidArgumentException;
use Resend\Service\Service;
use Resend\ValueObjects\Transporter\Payload;

class Batch extends Service
{
    /**
     * Add up to 100 email addresses to the suppression list at once.
     *
     * @param array{'emails': string[]} $parameters
     * @return \Resend\Collection<\Resend\Suppression>
     *
     * @see https://resend.com/docs/api-reference/suppressions/add-suppressions
     */
    public function add(array $parameters): \Resend\Collection
    {
        $payload = Payload::create('suppressions/batch/add', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }

    /**
     * Remove up to 100 suppressions from the suppression list at once.
     *
     * @param array{'emails'?: string[], 'ids'?: string[]} $parameters
     * @return \Resend\Collection<\Resend\Suppression>
     *
     * @see https://resend.com/docs/api-reference/suppressions/remove-suppressions
     */
    public function remove(array $parameters): \Resend\Collection
    {
        $hasEmails = array_key_exists('emails', $parameters);
        $hasIds = array_key_exists('ids', $parameters);

        if (! ($hasEmails xor $hasIds)) {
            throw new InvalidArgumentException("Provide either 'emails' or 'ids', but not both.");
        }

        $payload = Payload::create('suppressions/batch/remove', $parameters);

        $result = $this->transporter->request($payload);

        return $this->createResource('suppressions', $result);
    }
}
