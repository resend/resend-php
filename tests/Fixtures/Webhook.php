<?php

function webhook()
{
    return [
        'object' => 'webhook',
        'id' => '4dd369bc-aa82-4ff3-97de-514ae3000ee0',
        'created_at' => '2023-08-22T15:28:00.000Z',
        'status' => 'enabled',
        'endpoint' => 'https://webhook.example.com/handler',
        'events' => ['email.sent', 'email.received'],
        'signing_secret' => 'whsec_xxxxxxxxxx',
    ];
}

function webhooks()
{
    return [
        'object' => 'list',
        'data' => [
            [
                'object' => 'webhook',
                'id' => '4dd369bc-aa82-4ff3-97de-514ae3000ee0',
                'created_at' => '2023-08-22T15:28:00.000Z',
                'status' => 'enabled',
                'endpoint' => 'https://webhook.example.com/handler',
                'events' => ['email.sent', 'email.received'],
                'signing_secret' => 'whsec_xxxxxxxxxx',
            ],
        ],
    ];
}

function webhookRequest(?int $timestamp = null)
{
    $payload = '{"test": 2432232315}';
    $secret = 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $id = 'msg_p5jXN8AQM9LWM0D4loKWxJek';

    $toSign = "{$id}.{$timestamp}.{$payload}";
    $signature = base64_encode(pack('H*', hash_hmac('sha256', $toSign, base64_decode($secret))));

    $headers = [
        'svix-id' => $id,
        'svix-signature' => "v1,{$signature}",
        'svix-timestamp' => $timestamp,
    ];

    return [
        'payload' => $payload,
        'headers' => $headers,
    ];
}
