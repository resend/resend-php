<?php

namespace Resend;

use Resend\Contracts\Client as ClientContract;
use Resend\Contracts\Transporter;
use Resend\Service\ServiceFactory;

/**
 * Client used to send requests to the Resend API.
 *
 * @property \Resend\Service\ApiKey $apiKeys
 * @property \Resend\Service\Audience $audiences
 * @property \Resend\Service\Batch $batch
 * @property \Resend\Service\Contact $contacts
 * @property \Resend\Service\Domain $domains
 * @property \Resend\Service\Email $emails
 */
class Client implements ClientContract
{
    /**
     * The service factory instance.
     */
    private ServiceFactory $serviceFactory;

    /**
     * Create a new Client instance with the given transporter.
     */
    public function __construct(
        private readonly Transporter $transporter
    ) {
        //
    }

    /**
     * Send an email with the given parameters.
     *
     * @deprecated
     * @see @see https://resend.com/docs/api-reference/emails/send-email#body-parameters
     */
    public function sendEmail(array $parameters): Email
    {
        return $this->emails->send($parameters);
    }

    /**
     * Magic method to retrieve a service by name.
     */
    public function __get(string $name)
    {
        return $this->getService($name);
    }

    /**
     * Magic method to retrieve a service by name.
     */
    public function __call(string $name, array $arguments)
    {
        return $this->getService($name);
    }

    /**
     * Attach the given API service to the client.
     */
    private function getService(string $name)
    {
        if (! isset($this->serviceFactory)) {
            $this->serviceFactory = new ServiceFactory($this->transporter);
        }

        return $this->serviceFactory->getService($name);
    }
}
