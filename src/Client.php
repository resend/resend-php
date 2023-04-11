<?php

namespace Resend;

use Resend\Contracts\Transporter;
use Resend\Resources\ApiKeys;
use Resend\Resources\Domains;
use Resend\Responses\Email\Sent;
use Resend\ValueObjects\Transporter\Payload;

class Client
{
    /**
     * The service handling the API Keys API.
     */
    public ApiKeys $apiKeys;

    /**
     * The service handling the Domains API.
     */
    public Domains $domains;

    /**
     * Create a new Client instance with the given transporter.
     */
    public function __construct(
        private readonly Transporter $transporter
    ) {
        $this->attachServices();
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

    /**
     * Attach the API services to the client.
     */
    private function attachServices(): void
    {
        $this->apiKeys = new ApiKeys($this->transporter);
        $this->domains = new Domains($this->transporter);
    }
}
