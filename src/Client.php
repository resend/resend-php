<?php

namespace Resend;

use Resend\Contracts\Client as ClientContract;
use Resend\Contracts\Transporter;
use Resend\Service\ServiceFactory;

/**
 * Client used to send requests to the Resend API.
 *
 * @property Service\ApiKey $apiKeys
 * @property Service\Audience $audiences
 * @property Service\Batch $batch
 * @property Service\Broadcast $broadcasts
 * @property Service\Contact $contacts
 * @property Service\ContactProperty $contactProperties
 * @property Service\Domain $domains
 * @property Service\Email $emails
 * @property Service\Segment $segments
 * @property Service\Template $templates
 * @property Service\Topic $topics
 * @property Service\Webhook $webhooks
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
