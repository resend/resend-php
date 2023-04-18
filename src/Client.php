<?php

namespace Resend;

use Resend\Contracts\Transporter;
use Resend\Responses\Email\Sent;
use Resend\Service\ServiceFactory;
use Resend\ValueObjects\Transporter\Payload;

/**
 * Client used to send requests to the Resend API.
 *
 * @property \Resend\Service\ApiKey $apiKeys
 * @property \Resend\Service\Domain $domains
 */
class Client
{
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
     * @see https://resend.com/docs/api-reference/send-email#body-parameters
     */
    public function sendEmail(array $parameters): Sent
    {
        $payload = Payload::create('email', $parameters);

        $result = $this->transporter->request($payload);

        return Sent::from($result);
    }

    public function __get(string $name)
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
