<?php

namespace Resend;

use Resend\Contracts\Transporter;
use Resend\Resources\ResourceFactory;
use Resend\Responses\Email\Sent;
use Resend\ValueObjects\Transporter\Payload;

/**
 * Client used to send requests to the Resend API.
 *
 * @property \Resend\Resources\ApiKeys $apiKeys
 * @property \Resend\Resources\ApiKeys $domains
 */
class Client
{
    private ResourceFactory $resourceFactory;

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
        return $this->getResource($name);
    }

    /**
     * Attach the API services to the client.
     */
    private function getResource(string $name)
    {
        if (! isset($this->resourceFactory)) {
            $this->resourceFactory = new ResourceFactory($this->transporter);
        }

        return $this->resourceFactory->getResource($name);
    }
}
