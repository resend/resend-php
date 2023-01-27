<?php

use GuzzleHttp\Client as GuzzleClient;
use Resend\Client;
use Resend\Transporters\HttpTransporter;
use Resend\ValueObjects\ApiKey;

final class Resend
{
    /**
     * Creates a new Resend Client with the given API key.
     */
    public static function client(string $apiKey): Client
    {
        $apiKey = ApiKey::from($apiKey);

        $baseUri = 'api.resend.com';

        $headers = null;

        $client = new GuzzleClient();

        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter);
    }
}
