<?php

function webhook()
{
    return [
        'object' => 'webhook',
        'id' => '4dd369bc-aa82-4ff3-97de-514ae3000ee0',
        'created_at' => '2023-08-22 15:28:00+00',
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
                'created_at' => '2023-08-22 15:28:00+00',
                'status' => 'enabled',
                'endpoint' => 'https://webhook.example.com/handler',
                'events' => ['email.sent', 'email.received'],
                'signing_secret' => 'whsec_xxxxxxxxxx',
            ],
        ],
    ];
}

function webhookEvents()
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2',
                'type' => 'email.sent',
                'created_at' => '2026-08-22T15:28:00.000Z',
                'status' => 'success',
            ],
        ],
    ];
}

function webhookEvent()
{
    return [
        'object' => 'webhook_event',
        'id' => 'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2',
        'type' => 'email.sent',
        'created_at' => '2026-08-22T15:28:00.000Z',
        'status' => 'success',
        'next_attempt_at' => null,
        'payload' => [
            'type' => 'email.sent',
            'created_at' => '2026-08-22T15:28:00.000Z',
            'data' => [
                'email_id' => '571f1f42-1c2d-4b1f-8f8e-8b3b5b3b5b3b',
                'from' => 'onboarding@resend.dev',
                'to' => ['delivered@resend.dev'],
                'subject' => 'Welcome',
                'created_at' => '2026-08-22T15:27:59.000Z',
            ],
        ],
    ];
}

function webhookEventAttempts()
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'atmpt_1srOrx2ZWZBpBUvZwXKQmoEYga2',
                'http_status_code' => 200,
                'response' => '{"ok":true}',
                'sent_at' => '2026-08-22T15:33:12.000Z',
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
